<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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

	public function showModule($id) {
		$this->authorizeAdmin();
        return view('admin.module.show', ['module' => Module::find($id)]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createModule()
    {
		$this->authorizeAdmin();
        return view('admin.module.create');
    }

	public function editModule($id) {
		$this->authorizeAdmin();
        return view('admin.module.edit', ['module' => Module::find($id)]);
	}

	public function storeModule(Request $request) {
		$request->validate([
			'username' => ['required', 'max:255', Rule::unique('modules')->ignore($id)],
			'email' => ['required', 'max:255', Rule::unique('modules')->ignore($id)],
		]); // unique rule without itself 

		Module::create([
			'username' => $request->username,
			'email' => $request->email,
		]);
		$request->session()->flash('message', 'Module created.');
		return $this->lectureContent();
	}

	public function updateModule(Request $request, $id) {
		$request->validate([
			'username' => ['required', 'max:255', Rule::unique('modules')->ignore($id)],
			'email' => ['required', 'max:255', Rule::unique('modules')->ignore($id)],
		]); // unique rule without itself 

		Module::find($id)->update([
			'username' => $request->username,
			'email' => $request->email,
		]);
		$request->session()->flash('message', 'Module updated.');
		return $this->lectureContent();
	}

	public function destroyModule($id) {
			Module::find($id)->delete();

			// check deleted or not
			if (!Module::find($id)) {
				$request->session()->flash('message', 'Module deleted.');
				return $this->lectureContent;
			}
			else
				throw new RuntimeException(sprintf('Could not delete drink with id '.$id));
		}
	}
}
