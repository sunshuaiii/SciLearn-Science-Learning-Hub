<?php

namespace App\Http\Controllers;

use App\Models\CollectionTopic;
use App\Models\Collection;
use App\Models\Topic;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection as DBCollection;


class TopicController extends Controller
{
    //
    public function showTopics($collectionId)
    {
        $collection = Collection::find($collectionId);
        $collectionTopics = CollectionTopic::where('collection_id', $collectionId)->get();
        $addedTopics = DBCollection::make();

        foreach($collectionTopics as $item) {
            $topic = Topic::findOrFail($item->topic_id);
            $addedTopics->push($topic);
        }

        $otherTopics = Topic::all();

        $topicsWithTag1 = DBCollection::make();
        $topicsWithTag2 = DBCollection::make();
        $topicsWithTag3 = DBCollection::make();
        $topicsWithTag4 = DBCollection::make();

        foreach($otherTopics as $item) {
            
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

        return view('showTopics',[
            'collection' => $collection, 
            'addedTopics' =>$addedTopics,
            'topicsWithTag1' => $topicsWithTag1,
            'topicsWithTag2' => $topicsWithTag2,
            'topicsWithTag3' => $topicsWithTag3,
            'topicsWithTag4' => $topicsWithTag4,
        ]);
    }

    public function addTopic(Request $request, $collectionId)
    {
        $collectionTopics = new CollectionTopic;
        $collectionTopics->collection_id = $collectionId;
        $collectionTopics->topic_id = $request->id;
        $collectionTopics->save();
        
        return redirect()->back();
    }
}
