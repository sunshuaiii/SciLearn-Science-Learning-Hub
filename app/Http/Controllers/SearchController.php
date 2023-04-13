<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Topic;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $moduleNames = [];
        // Get the search term from the request
        $searchTerm = $request->input('searchTerm');

        // Perform the search using the search term
        $results = Topic::where('name', 'LIKE', "%$searchTerm%")->get();

        // Retrieve an array of module names corresponding to the search results
        $moduleNames = $results->map(function ($result) {
            $moduleName = DB::table('modules')
                ->where('id', $result->module_id)
                ->value('name');
            return $moduleName;
        })->toArray();

        // Add the module names to the search results array as a new key
        foreach ($results as $key => $result) {
            $results[$key]->moduleName = $moduleNames[$key];
        }

        if (Auth::guard(session('role'))->user()) {
            $user = Auth::guard(session('role'))->user();
            $quizzesTaken = $user->getQuizzes;
            $progress = [];
            $i = 0;

            foreach ($results as $topic) {
                $numberOfQuiz = $topic->getArticles->count();
                $quizzesTakenCount = 0;
                foreach ($topic->getArticles as $article) {
                    if ($quizzesTaken->contains($article->getQuiz))
                        $quizzesTakenCount++;
                }
                if ($quizzesTakenCount == 0) {
                    $progress[$i++] = 0;
                } else {
                    $progress[$i++] = $quizzesTakenCount / $numberOfQuiz;
                }
            }
            return view('searchResults', ['results' => $results, 'progress' => $progress,]);
        }

        // Pass the search results to the view
        return view('searchResults', ['results' => $results]);
    }
}
