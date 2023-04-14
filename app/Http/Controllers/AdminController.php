<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Module;
use App\Models\Article;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\CollectionTopic;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
	// public function __construct()
	// {
	// 	// always authorize admin before using any method in this controller
	// 	$this->authorizeAdmin();
	// }

	private function authorizeAdmin()
	{
		try {
			// Auth is accessble after logined
			if (!Auth::guard('admin')->user()->can('isAdmin')) { // if login user not admin
				abort(404);
			}
		} catch (\Throwable $e) { // if user not logined
			abort(404);
		}
	}

	public function lectureContent()
	{
		$this->authorizeAdmin();
		return view('admin.lectureContent');
	}

	public function showModule($id)
	{
		$this->authorizeAdmin();
		return view('admin.module.show', ['module' => Module::find($id)]);
	}

	public function showTopic($id)
	{
		$this->authorizeAdmin();
		return view('admin.topic.show', ['topic' => Topic::find($id)]);
	}

	public function createTopic($module_id)
	{
		$this->authorizeAdmin();
		return view('admin.topic.create', ['module_id' => $module_id]);
	}

	public function editTopic($id)
	{
		$this->authorizeAdmin();
		$module_id = Topic::where('id', $id)->get()->value('module_id');
		return view('admin.topic.edit', ['topic' => Topic::find($id), 'module_id' => $module_id]);
	}

	public function storeTopic(Request $request)
	{
		$this->authorizeAdmin();
		$request->validate([
			'name' => ['required', Rule::unique('topics')],
			'image' => 'required',
			'module_id' => 'required|exists:App\Models\Module,id',
		]); // unique rule without itself 

		$topic = new Topic;

		$topic->name = $request->name;
		$topic->tag = $request->tag ? $request->tag : "";
		$topic->module_id = $request->module_id;
		$topic->image = $request->image;
		$topic->save();

		$request->session()->flash('message', 'Topic created.');
		return $this->showTopic($topic->id);
	}

	public function updateTopic(Request $request, $id)
	{
		$this->authorizeAdmin();
		$request->validate([
			'name' => ['required', Rule::unique('topics')->ignore($id)],
			'tag' => 'required',
			'image' => 'required',
			'module_id' => 'required|exists:App\Models\Module,id',
		]); // unique rule without itself 

		$topic = Topic::find($id);

		$topic->name = $request->name;
		$topic->tag = $request->tag ? $request->tag : "";
		$topic->module_id = $request->module_id;
		$topic->image = $request->image;
		$topic->save();

		$request->session()->flash('message', 'Topic updated.');
		return $this->showTopic($id);
	}

	public function destroyTopic(Request $request, $id)
	{
		$this->authorizeAdmin();

		// delete the topic and the associated articles, quizzes and questions
		$articlesIds = Article::where('topic_id', $id)->pluck('id');

		for ($i = 0; $i < count($articlesIds); $i++) {
			$quizzesIds = Quiz::where('article_id', $articlesIds[$i])->pluck('id');

			for ($j = 0; $j < count($quizzesIds); $j++) {
				Question::where('quiz_id', $quizzesIds[$j])->delete();
			}
			Quiz::where('article_id', $articlesIds[$i])->delete();
		}

		Article::where('topic_id', $id)->delete();
		Topic::find($id)->delete();

		// delete the topic in the collection_topics table
		CollectionTopic::where('topic_id', $id)->delete();

		// check deleted or not
		if (!Topic::find($id)) {
			$request->session()->flash('message', 'Topic deleted.');
			return $this->lectureContent();
		} else
			throw new RuntimeException(sprintf('Could not delete the topic with id ' . $id));
	}

	public function showArticle($id)
	{
		$this->authorizeAdmin();
		$topic_id = Article::where('id', $id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.article.show', ['article' => Article::find($id), 'module_id' => $module_id, 'topic_id' => $topic_id]);
	}

	public function createArticle($topic_id)
	{
		$this->authorizeAdmin();
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.article.create', ['topic_id' => $topic_id, 'module_id' => $module_id]);
	}

	public function editArticle($id)
	{
		$this->authorizeAdmin();
		$topic_id = Article::where('id', $id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.article.edit', ['article' => Article::find($id), 'module_id' => $module_id, 'topic_id' => $topic_id]);
	}

	public function storeArticle(Request $request)
	{
		$this->authorizeAdmin();

		$request->validate([
			'title' => ['required', Rule::unique('articles')],
			'content' => 'required',
			'image' => 'required',
			'topic_id' => 'required|exists:App\Models\Topic,id',
		]); // unique rule without itself 

		$article = new Article;

		$article->title = $request->title;
		$article->content = $request->content;
		$article->image = $request->image;
		$article->topic_id = $request->topic_id;
		$article->save();

		$request->session()->flash('message', 'Article created.');
		return $this->showArticle($article->id);
	}

	public function updateArticle(Request $request, $id)
	{
		$this->authorizeAdmin();

		$request->validate([
			'title' => ['required', Rule::unique('articles')],
			'topic_id' => 'required|exists:App\Models\Topic,id',
		]); // unique rule without itself 

		$article = Article::find($id);

		$article->title = $request->title;
		$article->content = $request->content;
		$article->image = $request->image;
		$article->topic_id = $request->topic_id;
		$article->save();

		$request->session()->flash('message', 'Article updated.');
		return $this->showArticle($id);
	}

	public function destroyArticle(Request $request, $id)
	{
		$this->authorizeAdmin();

		// delete the article and the associated quizzes and questions

		$quizzesIds = Quiz::where('article_id', $id)->pluck('id');

		for ($j = 0; $j < count($quizzesIds); $j++) {
			Question::where('quiz_id', $quizzesIds[$j])->delete();
		}
		Quiz::where('article_id', $id)->delete();

		Article::find($id)->delete();

		// check deleted or not
		if (!Article::find($id)) {
			$request->session()->flash('message', 'Article deleted.');
			return $this->lectureContent();
		} else
			throw new RuntimeException(sprintf('Could not delete the article with id ' . $id));
	}

	public function showQuiz($id)
	{
		$this->authorizeAdmin();
		$article_id = Quiz::where('id', $id)->get()->value('article_id');
		$topic_id = Article::where('id', $article_id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.quiz.show', ['quiz' => Quiz::find($id), 'module_id' => $module_id, 'topic_id' => $topic_id, 'article_id' => $article_id]);
	}

	public function createQuiz($article_id)
	{
		$this->authorizeAdmin();
		$topic_id = Article::where('id', $article_id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.quiz.create', ['article_id' => $article_id, 'topic_id' => $topic_id, 'module_id' => $module_id]);
	}

	public function editQuiz($id)
	{
		$this->authorizeAdmin();
		$article_id = Quiz::where('id', $id)->get()->value('article_id');  // return the article id for the navigation
		$topic_id = Article::where('id', $article_id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.quiz.edit', ['quiz' => Quiz::find($id), 'module_id' => $module_id, 'topic_id' => $topic_id, 'article_id' => $article_id]);
	}

	public function storeQuiz(Request $request)
	{
		$this->authorizeAdmin();

		$request->validate([
			'name' => ['required', Rule::unique('quizzes')],
			'article_id' => ['required', Rule::unique('quizzes')],
		]); // unique rule without itself 

		$quiz = new Quiz;

		$quiz->name = $request->name;
		$quiz->article_id = $request->article_id;
		$quiz->save();

		$request->session()->flash('message', 'Quiz created.');
		return $this->showQuiz($quiz->id);
	}

	public function updateQuiz(Request $request, $id)
	{
		$this->authorizeAdmin();

		$request->validate([
			'name' => ['required', Rule::unique('quizzes')],
			'article_id' => 'required|exists:App\Models\Article,id',
		]); // unique rule without itself 

		$quiz = Quiz::find($id);

		$quiz->name = $request->name;
		$quiz->article_id = $request->article_id;
		$quiz->save();

		$request->session()->flash('message', 'Quiz updated.');
		return $this->showQuiz($id);
	}

	public function destroyQuiz(Request $request, $id)
	{
		$this->authorizeAdmin();

		// delete the quiz and the associated questions
		Question::where('quiz_id', $id)->delete();
		Quiz::find($id)->delete();

		// check deleted or not
		if (!Quiz::find($id)) {
			$request->session()->flash('message', 'Quiz deleted.');
			return $this->lectureContent();
		} else
			throw new RuntimeException(sprintf('Could not delete the quiz with id ' . $id));
	}

	public function showQuestion($id)
	{
		$this->authorizeAdmin();
		$quiz_id = Question::where('id', $id)->get()->value('quiz_id');// return the quiz id for the navigation
		$article_id = Quiz::where('id', $quiz_id)->get()->value('article_id');// return the article id for the navigation
		$topic_id = Article::where('id', $article_id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		$questions = Question::where('quiz_id', $quiz_id)->get();
		return view('admin.question.show', ['question_id' => $id, 'questions' => $questions, 'question' => Question::find($id), 'module_id' => $module_id, 'topic_id' => $topic_id, 'article_id' => $article_id, 'quiz_id' => $quiz_id]);
	}

	public function createQuestion($quiz_id)
	{
		$this->authorizeAdmin();
		$questions = Question::where('quiz_id', $quiz_id)->get();
		$article_id = Quiz::where('id', $quiz_id)->get()->value('article_id');  // return the article id for the navigation
		$topic_id = Article::where('id', $article_id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.question.create', ['questions' => $questions, 'quiz_id' => $quiz_id, 'topic_id' => $topic_id, 'module_id' => $module_id, 'article_id' => $article_id]);
	}

	public function editQuestion($id)
	{
		$this->authorizeAdmin();
		$quiz_id = Question::where('id', $id)->get()->value('quiz_id');  // return the quiz id for the navigation
		$article_id = Quiz::where('id', $quiz_id)->get()->value('article_id');  // return the article id for the navigation
		$topic_id = Article::where('id', $article_id)->get()->value('topic_id');  // return the topic id for the navigation
		$module_id = Topic::where('id', $topic_id)->get()->value('module_id');	// return the module id for the navigation
		return view('admin.question.edit', ['question' => Question::find($id), 'question_id' => $id, 'quiz' => Quiz::find($id), 'module_id' => $module_id, 'topic_id' => $topic_id, 'article_id' => $article_id, 'quiz_id' => $quiz_id]);
	}

	public function storeQuestion(Request $request)
	{
		$this->authorizeAdmin();

		$request->validate([
			'question' => ['required', Rule::unique('questions')],
			'option1' => 'required',
			'option2' => 'required',
			'option3' => 'required',
			'option4' => 'required',
			'answer' => 'required',
			'explanation' => 'required',
			'quiz_id' => 'required|exists:App\Models\Quiz,id',
		]); // unique rule without itself 

		$question = new Question;

		$question->question = $request->question;
		$question->option1 = $request->option1;
		$question->option2 = $request->option2;
		$question->option3 = $request->option3;
		$question->option4 = $request->option4;
		$question->answer = $request->answer;
		$question->explanation = $request->explanation;
		$question->quiz_id = $request->quiz_id;
		$question->save();

		$request->session()->flash('message', 'Question created.');
		return $this->showQuestion($question->id);
	}

	public function updateQuestion(Request $request, $id)
	{
		$this->authorizeAdmin();

		$request->validate([
			'question' => ['required', Rule::unique('questions')],
			'option1' => 'required',
			'option2' => 'required',
			'option3' => 'required',
			'option4' => 'required',
			'answer' => 'required',
			'explanation' => 'required',
			'quiz_id' => 'required|exists:App\Models\Quiz,id',
		]); // unique rule without itself 

		$question = Question::find($id);

		$question->question = $request->question;
		$question->option1 = $request->option1;
		$question->option2 = $request->option2;
		$question->option3 = $request->option3;
		$question->option4 = $request->option4;
		$question->answer = $request->answer;
		$question->explanation = $request->explanation;
		$question->quiz_id = $request->quiz_id;
		$question->save();

		$request->session()->flash('message', 'Question updated.');
		return $this->showQuestion($id);
	}

	public function destroyQuestion(Request $request, $id)
	{
		$this->authorizeAdmin();

		Question::find($id)->delete();

		// check deleted or not
		if (!Question::find($id)) {
			$request->session()->flash('message', 'Question deleted.');
			return $this->lectureContent();
		} else
			throw new RuntimeException(sprintf('Could not delete the question with id ' . $id));
	}
}
