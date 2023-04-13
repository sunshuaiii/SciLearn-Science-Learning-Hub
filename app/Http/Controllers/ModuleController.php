<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Module;
use App\Models\Article;
use App\Models\Leaderboard;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\UserQuiz;

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

        if (Auth::guard(session('role'))->user()) {
            $user = Auth::guard(session('role'))->user();
            $quizzesTaken = $user->getQuizzes;
            $progress = [];
            $i = 0;

            foreach (Module::take(3)->get() as $module) {
                foreach ($module->getTopics as $topic) {
                    $numberOfQuiz = $topic->getArticles->count();
                    $quizzesTakenCount = 0;
                    foreach ($topic->getArticles as $article) {
                        // return Quiz::find(1);
                        // return Quiz::where('article_id', $article->id)->get();
                        if ($quizzesTaken->contains($article->getQuiz))
                            $quizzesTakenCount++;
                    }
                    $progress[$i++] = $quizzesTakenCount / $numberOfQuiz;
                }
            }
            return view('topics', [
                'moduleName' => $moduleName,
                'moduleNameToShow' => $moduleNameToShow,
                'topicsWithTag1' => $topicsWithTag1,
                'topicsWithTag2' => $topicsWithTag2,
                'topicsWithTag3' => $topicsWithTag3,
                'topicsWithTag4' => $topicsWithTag4,
                'progress' => $progress,
            ]);
        }

        return view('topics', [
            'moduleName' => $moduleName,
            'moduleNameToShow' => $moduleNameToShow,
            'topicsWithTag1' => $topicsWithTag1,
            'topicsWithTag2' => $topicsWithTag2,
            'topicsWithTag3' => $topicsWithTag3,
            'topicsWithTag4' => $topicsWithTag4,
        ]);
    }

    public function showArticles($moduleName, $topicId)
    {
        $completed = [];
        $i = 0;
        $topic = Topic::find($topicId);

        // check if the topicId is selected
        // no topicId will be selected if is a challenge
        if (!$topic) {
            if (Auth::guard(session('role'))->user()) {
                // start challenge
                // select 10 random records from the 'questions' table. 
                $questions = DB::table('questions')->inRandomOrder()->take(10)->get();
                return view('challenges', ['questions' => $questions]);
            }
            return redirect('/login/student');
        }

        $topicName = $topic->name;
        $articles = Article::where('topic_id', $topicId)->get();
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        $articleIds = Article::where('topic_id', $topicId)->pluck('id');

        if (Auth::guard(session('role'))->user()) {
            $userId = Auth::guard(session('role'))->user()->id;
            foreach ($articleIds as $articleId) {
                // get the quiz ID for the article
                $quizId = DB::table('quizzes')->where('article_id', $articleId)->value('id');
                // check if the user has completed the quiz
                $completed[$i++] = DB::table('user_quizzes')->where('user_id', $userId)->where('quiz_id', $quizId)->exists();
            }

            // Add the completed to the articles array as a new key
            foreach ($articles as $key => $result) {
                $articles[$key]->completed = $completed[$key];
            }
        }

        return view('articles', [
            'moduleName' => $moduleName,
            'moduleNameToShow' => $moduleNameToShow,
            'topicId' => $topicId,
            'topicName' => $topicName,
            'articles' => $articles
        ]);
    }

    public function showArticleContent($moduleName, $topicId, $articleId)
    {
        $article = Article::find($articleId);

        $topicName = Topic::find($topicId)->name;
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        return view('articleContent', [
            'article' => $article,
            'moduleName' => $moduleName,
            'moduleNameToShow' => $moduleNameToShow,
            'topicId' => $topicId,
            'topicName' => $topicName
        ]);
    }

    public function startQuiz($moduleName, $topicId, $articleId)
    {
        $quizId = Quiz::where('article_id', $articleId)->get()->value('id');
        $quizName = Quiz::where('article_id', $articleId)->get()->value('name');

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
            'articleId' => $articleId,
            'quizName' => $quizName
        ]);
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

        if (Auth::guard(session('role'))->user()) {
            $userId = Auth::guard(session('role'))->user()->id;
            // Check if the user ID and quiz ID combination already exists in the table
            if (DB::table('user_quizzes')->where('user_id', $userId)->where('quiz_id', $quizId)->count() == 0) {
                // If the combination is distinct, create a new record in the table
                $userQuiz = new UserQuiz;
                $userQuiz->user_id = $userId;
                $userQuiz->quiz_id = $quizId;
                $userQuiz->save();
            }
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

        $questions = json_decode($request->input('questions'), true);
        $questionNumber = range(0, 9);

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'answer') === 0) {
                $questionNumber = str_replace('answer', '', $key);
                $answers[$questionNumber - 1] = $value;
            }
        }

        for ($i = 0; $i < count($questions); $i++) {
            if ($answers[$i] === (string) $questions[$i]['answer']) {
                $score++;
            }
        }

        $totalQuestions = count($questions);
        $incorrectAnswers = $totalQuestions - $score;
        $percentage = round(($score / $totalQuestions) * 100, 2);
        $elapsedTime = $request->input('elapsed_time');
        $timeTaken = $_POST['time_taken'];

        if (Auth::guard(session('role'))->user()) {
            $userId = Auth::guard(session('role'))->user()->id;

            // Check if the user already in the leaderboard table
            // only the user who get 10/10 get enter the leaderboard
            // Check if the user already in the leaderboard table
            if ($score == 10) {
                $leaderboard = DB::table('leaderboards')->where('user_id', $userId)->first();

                if (!$leaderboard) {
                    // If the user first enter the leaderboard, create a new record in the table
                    $leaderboard = new Leaderboard();
                    $leaderboard->user_id = $userId;
                    $leaderboard->duration = $elapsedTime / 1000;
                    $leaderboard->save();
                } else {
                    if ($elapsedTime < $leaderboard->duration) {
                        // If the user already existed in the leaderboard and the current duration is shorter than the duration in the table,
                        // update the record in the table
                        $leaderboard = Leaderboard::where('user_id', $userId)->first();
                        $leaderboard->duration = $elapsedTime / 1000;
                        $leaderboard->save();
                    }
                }
            }
        }

        return view('challengesResult', [
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'incorrectAnswers' => $incorrectAnswers,
            'percentage' => $percentage,
            'timeTaken' => $timeTaken,
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }
}
