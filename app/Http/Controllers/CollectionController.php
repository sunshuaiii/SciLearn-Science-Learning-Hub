<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Topic;
use App\Models\CollectionTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection as DBCollection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the collection of current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $id = Auth::id();
        // $collections = Collection::all()->where('user_id', $id);
        $id = Auth::guard(session('role'))->user()->id;
        $collections = Collection::all()->where('user_id', $id);
        return view('collections', ['collections' => $collections]);
    }

    /**
     * Show the form for creating a new collection.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created collection in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::guard(session('role'))->user();
        $request->validate([
            'name' => 'required | between: 1, 60',
        ]);

        //check duplicate data
        if (Collection::where('user_id', $user->id)->where('name', $request->name)->count() > 0) {
            return redirect()->back()->withErrors(['collection.unique' => 'Collection exist! Create new collection with other name']);
        }

        $newCollection = new Collection;
        $newCollection->name = $request->name;
        $newCollection->user_id = $user->id;
        $newCollection->save();

        return redirect('collections');
    }

    /**
     * Display the specified collections.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $collection = Collection::findOrFail($id);
        $collectionTopics = CollectionTopic::where('collection_id', $id)->get();

        $topicsWithTag1 = DBCollection::make();
        $topicsWithTag2 = DBCollection::make();
        $topicsWithTag3 = DBCollection::make();
        $topicsWithTag4 = DBCollection::make();

        foreach($collectionTopics as $item) {
            
            $topic = Topic::findOrFail($item->topic_id);
            switch ($topic->tag) {
                case "Physics": 
                    $topicsWithTag1->push($topic);
                    break;
                case "Chemistry": 
                    $topicsWithTag2->push($topic);
                    break;
                case "Biology": 
                    $topicsWithTag3->push($topic);
                    break;
                case " ": 
                    $topicsWithTag4->push($topic);
                    break;
                default:
                    break;
            }
        }

        return view('topics', [
            'moduleName' => $collection->id, 
            'moduleNameToShow' => $collection->name,
            'topicsWithTag1' => $topicsWithTag1,
            'topicsWithTag2' => $topicsWithTag2,
            'topicsWithTag3' => $topicsWithTag3,
            'topicsWithTag4' => $topicsWithTag4,
            'isCollection' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    // public function edit(Request $request)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user = Auth::guard(session('role'))->user();
        $request->validate([
            'name' => 'required | between: 1, 60',
        ]);

        $collection = Collection::find($request->id);

        if ($request->name == $collection->name){ // user did not change the name
            return redirect()->route('collections.show',[$request->id]);
        }else if (Collection::where('user_id', $user->id)->where('name', $request->name)->count() > 0) { //check duplicate data
            return redirect()->back()->withErrors(['collection.unique' => 'Collection exist! Create new collection with other name']);
        }
        
        $collection->name = $request->name;
        $collection->save();
        return redirect()->route('collections.show',[$request->id]);
        // return redirect('/collections/{$request->id}');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = Auth::guard(session('role'))->user();

        // $collectionTopics = CollectionTopic::where('collection_id', $id);
        // foreach($collectionTopics as $item) {
        //     $item->delete();
        // }

        $collection = Collection::findOrFail($id);
        $collection->delete();

        $collections= Collection::all()->where('user_id', $user->id);
        return redirect()->route('collections.index', ['collections' => $collections]);
    }
}
