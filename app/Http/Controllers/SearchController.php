<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Topic;
use App\Models\Article;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('q');
    
        $results = Topic::where('name', 'LIKE', "%$search%")->get();

        return view('searchResults', compact('results'));
    }
}