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

	public function storeModule() {
		$request->validate([
			'username' => 'required|unique:users|max:255',
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:8|confirmed',
		]); // if invalid, return back to the original page and show error message
		User::create([
			'username' => $request->username,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'avatar_id' => 0,
		]);

		$request->session()->flash('message', 'Module created.');
		return $this->lectureContent();
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->authorizeAdmin();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$this->authorizeAdmin();
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$this->authorizeAdmin();
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$this->authorizeAdmin();
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$this->authorizeAdmin();
        //
    }
}
