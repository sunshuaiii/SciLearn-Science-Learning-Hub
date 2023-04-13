<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Module;
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

	private function authorizeAdmin() {
		try {
			// Auth is accessble after logined
			if (! Auth::guard('admin')->user()->can('isAdmin')) { // if login user not admin
				abort(404);
			}
		} catch (\Throwable $e) { // if user not logined
			abort(404);
		}
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lectureContent()
    {
		$this->authorizeAdmin();
        return view('admin.lectureContent');
    }

	public function showModule($id) {
		$this->authorizeAdmin();
        return view('admin.module.show', ['module' => Module::find($id)]);
	}

	public function showTopic($id) {
		$this->authorizeAdmin();
        return view('admin.topic.show', ['topic' => Topic::find($id)]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTopic($module_id)
    {
		$this->authorizeAdmin();
        return view('admin.topic.create', ['module_id' => $module_id]);
    }

	public function editTopic($id) {
		$this->authorizeAdmin();
        return view('admin.topic.edit', ['topic' => Topic::find($id)]);
	}

	public function storeTopic(Request $request) {
		$this->authorizeAdmin();
		$request->validate([
			'name' => ['required', Rule::unique('topics')],
			'module_id' => 'required|exists:App\Models\Module,id',
			// 'image' => ['required', 'image', Rule::unique('topics')->ignore($id)],
		]); // unique rule without itself 

		$topic = new Topic;
		
		$topic->name = $request->name;
		$topic->tag = $request->tag ? $request->tag : "";
		$topic->module_id = $request->module_id;
		$topic->image = "unknown";
		$topic->save();
		
		$request->session()->flash('message', 'Topic created.');
		return $this->showTopic($topic->id);
	}

	public function updateTopic(Request $request, $id) {
		$this->authorizeAdmin();
		$request->validate([
			'name' => ['required', Rule::unique('topics')->ignore($id)],
			'module_id' => 'required|exists:App\Models\Module,id',
			// 'image' => ['required', 'image', Rule::unique('topics')->ignore($id)],
		]); // unique rule without itself 

		$topic = Topic::find($id);
		
		$topic->name = $request->name;
		$topic->tag = $request->tag ? $request->tag : "";
		$topic->module_id = $request->module;
		// $topic->image = $request->image;
		$topic->save();
		
		$request->session()->flash('message', 'Topic updated.');
		return $this->showTopic($id);
	}

	public function destroyTopic(Request $request, $id) {
		$this->authorizeAdmin();
		Topic::find($id)->delete();

		// check deleted or not
		if (!Topic::find($id)) {
			$request->session()->flash('message', 'Topic deleted.');
			return $this->lectureContent();
		}
		else
			throw new RuntimeException(sprintf('Could not delete drink with id '.$id));
	}
}
