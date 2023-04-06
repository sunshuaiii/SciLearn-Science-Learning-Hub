<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('topics', ['moduleName' => $moduleName, 'moduleNameToShow' => $moduleNameToShow, 
            'topicsWithTag1' => $topicsWithTag1, 'topicsWithTag2' => $topicsWithTag2, 
            'topicsWithTag3' => $topicsWithTag3, 'topicsWithTag4' => $topicsWithTag4]);
    }

    public function showArticles($moduleName, $topicId){
        $topicName = Topic::find($topicId)->name;
        $articles = Article::where('topic_id', $topicId)->get();
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        return view('articles', ['moduleName' => $moduleName, 'moduleNameToShow' => $moduleNameToShow, 'topicId' => $topicId, 'topicName' => $topicName, 'articles' => $articles]);
    }

    public function showArticleContent($moduleName, $topicId, $articleId){
        $article = Article::find($articleId);

        $topicName = Topic::find($topicId)->name;
        $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        return view('articleContent', ['article' => $article, 'moduleNameToShow' => $moduleNameToShow, 'topicName' => $topicName]);
    }

    public function startQuiz($moduleName, $topicId, $articleId){
        $quizId = Quiz::where('article_id', $articleId)->get()->id;

        $questions = Question::where('quiz_id', $quizId)->get();
        echo $questions;

        // $topicName = Topic::find($topicId)->name;
        // $moduleNameToShow = ucwords(str_replace('-', ' ', $moduleName));

        // return view('quiz', ['questions' => $questions, 'moduleNameToShow' => $moduleNameToShow, 'topicName' => $topicName]);
    }

    public function startChallenge(){
        //
    }
}
