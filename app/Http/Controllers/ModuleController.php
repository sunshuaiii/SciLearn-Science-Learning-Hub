<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Module;
use App\Models\Article;
use App\Models\Quiz;
use App\Models\Question;

class ModuleController extends Controller
{
    //
    public function index()
    {
        return view('/modules', 'modules');
    }

    public function showTopics($moduleName)
    {
        $module = Module::where('name', $moduleName)->first();
        if ($module) {
            $moduleId = $module->id;
        } else {
            // Module not found
        }

        $topicsWithTag1 = Topic::where('module_id', $moduleId)->where('tag', "Physics")->get();
        $topicsWithTag2 = Topic::where('module_id', $moduleId)->where('tag', "Chemistry")->get();
        $topicsWithTag3 = Topic::where('module_id', $moduleId)->where('tag', "Biology")->get();
        $topicsWithTag4 = Topic::where('module_id', $moduleId)->where('tag', " ")->get();

        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        return view('topics', [
            'moduleName' => $moduleName, 
            'moduleNameToShow' => $moduleNameToShow, 
            'topicsWithTag1' => $topicsWithTag1, 
            'topicsWithTag2' => $topicsWithTag2, 
            'topicsWithTag3' => $topicsWithTag3, 
            'topicsWithTag4' => $topicsWithTag4,
            'isCollection' => false,
        ]);
    }

    public function showArticles($moduleName, $topicId)
    {
        $topic = Topic::find($topicId);

        // check if the topicId is selected
        // no topicId will be selected if is a challenge
        if (!$topic) {
            // start challenge
            // select 10 random records from the 'questions' table. 
            $questions = DB::table('questions')->inRandomOrder()->take(10)->get();
            return view('challenges', ['questions' => $questions]);
        }

        $topicName = $topic->name;
        $articles = Article::where('topic_id', $topicId)->get();
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        return view('articles', [
            'moduleName' => $moduleName, 
            'moduleNameToShow' => $moduleNameToShow, 
            'topicId' => $topicId, 
            'topicName' => $topicName, 
            'articles' => $articles]);
    }

    public function showArticleContent($moduleName, $topicId, $articleId)
    {
        $article = Article::find($articleId);

        $topicName = Topic::find($topicId)->name;
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        return view('articleContent', ['article' => $article, 
        'moduleName' => $moduleName, 
        'moduleNameToShow' => $moduleNameToShow, 
        'topicId' => $topicId, 
        'topicName' => $topicName]);
    }

    public function startQuiz($moduleName, $topicId, $articleId)
    {
        $quizId = Quiz::where('article_id', $articleId)->get()->value('id');

        $questions = Question::where('quiz_id', $quizId)->get();

        $topicName = Topic::find($topicId)->name;
        $articleTitle = Article::find($articleId)->title;
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        return view('quiz', [
            'questions' => $questions, 
            'moduleName' => $moduleName, 
            'moduleNameToShow' => $moduleNameToShow, 
            'topicName' => $topicName, 
            'articleTitle' => $articleTitle, 
            'topicId' => $topicId, 
            'articleId' => $articleId]);
    }

    public function submitQuiz(Request $request, $moduleName, $topicId, $articleId)
    {
        $topicName = Topic::find($topicId)->name;
        $articleTitle = Article::find($articleId)->title;
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        $score = 0;
        $answers = [];

        $quizId = Quiz::where('article_id', $articleId)->get()->value('id');
        $questions = Question::where('quiz_id', $quizId)->get();

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'answer') === 0) {
                $questionNumber = str_replace('answer', '', $key);
                $answers[$questionNumber - 1] = $value;
            }
        }

        for ($i = 0; $i < count($questions); $i++) {
            if ($answers[$i] === (string) $questions[$i]->answer) {
                $score++;
            }
        }

        $totalQuestions = count($questions);
        $incorrectAnswers = $totalQuestions - $score;
        $percentage = round(($score / $totalQuestions) * 100, 2);
        $timeTaken = $request->input('time-taken');

        if(auth()->check()) {
            $userId = auth()->id();
            $userQuiz = new UserQuiz;
            $userQuiz->user_id = Auth::id();
            $userQuiz->quiz_id = $quizId;
            $userQuiz->save();
        }


        return view('quizResult', [
            'moduleName' => $moduleName, 
            'moduleNameToShow' => $moduleNameToShow, 
            'topicName' => $topicName, 
            'articleTitle' => $articleTitle, 
            'topicId' => $topicId, 
            'articleId' => $articleId,
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'incorrectAnswers' => $incorrectAnswers,
            'percentage' => $percentage,
            'timeTaken' => $timeTaken,
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }

    public function submitChallenges(Request $request)
    {
        $score = 0;
        $answers = [];

        $quizId = Quiz::where('article_id', $articleId)->get()->value('id');
        $questions = Question::where('quiz_id', $quizId)->get();

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'answer') === 0) {
                $questionNumber = str_replace('answer', '', $key);
                $answers[$questionNumber - 1] = $value;
            }
        }

        for ($i = 0; $i < count($questions); $i++) {
            if ($answers[$i] === (string) $questions[$i]->answer) {
                $score++;
            }
        }

        $totalQuestions = count($questions);
        $incorrectAnswers = $totalQuestions - $score;
        $percentage = round(($score / $totalQuestions) * 100, 2);
        $timeTaken = $request->input('time-taken');

        // $userQuiz = new UserQuiz;
        // $userQuiz->user_id = Auth::id();
        // $userQuiz->quiz_id = $quizId;
        // $userQuiz->save();

        return view('quizResult', [
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'incorrectAnswers' => $incorrectAnswers,
            'percentage' => $percentage,
            'timeTaken' => $timeTaken,
            // 'questions' => $questions,
            'answers' => $answers,
        ]);
    }
}
