<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;

class AdminController extends Controller
{
	private function authorizeAdmin() {
		if (! Auth::guard(session('role'))->user()->can('isAdmin')) {
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

	public function showTopic($id) {
		$this->authorizeAdmin();
        return view('admin.topic.show', ['topic' => Topic::find($id)]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTopic()
    {
		$this->authorizeAdmin();
        return view('admin.topic.create');
    }

	public function editTopic($id) {
		$this->authorizeAdmin();
        return view('admin.topic.edit', ['topic' => Topic::find($id)]);
	}

	public function storeTopic(Request $request) {
		$request->validate([
			'name' => ['required', Rule::unique('topics')->ignore($id)],
			'image' => ['required', 'image', Rule::unique('topics')->ignore($id)],
		]); // unique rule without itself 

		Topic::find($id)->update([
			'name' => $request->name,
			'image' => $request->image,
		]);
		$request->session()->flash('message', 'Topic created.');
		return $this->lectureContent();
	}

	public function updateTopic(Request $request, $id) {
		$request->validate([
			'name' => ['required', Rule::unique('topics')->ignore($id)],
			'image' => ['required', 'image', Rule::unique('topics')->ignore($id)],
		]); // unique rule without itself 

		Topic::find($id)->update([
			'name' => $request->name,
			'image' => $request->image,
		]);
		$request->session()->flash('message', 'Topic updated.');
		return $this->lectureContent();
	}

	public function destroyTopic($id) {
		Topic::find($id)->delete();

		// check deleted or not
		if (!Topic::find($id)) {
			$request->session()->flash('message', 'Topic deleted.');
			return $this->lectureContent;
		}
		else
			throw new RuntimeException(sprintf('Could not delete drink with id '.$id));
	}
}
