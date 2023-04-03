<?php

namespace App\Http\Controllers\Admin;

use App\Group;  //bring in model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $groups = Group::orderBy('created_at','desc')->paginate(3);
       return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'groupName'=>'required',
            'groupAdmin'=>'required',
            'groupAdminEmail'=>'required',
            'groupBase'=>'required'
        ]);

        $group = new Group;
                        //column names                      //variable names in form
        $group->group_name = $request->input('groupName');
        $group->group_admin = $request->input('groupAdmin');
        $group->group_base = $request->input('groupBase');

        $group->save();

        return redirect('/groups/create')->with('success', 'Group has been successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        //
        $group = Group::find($id);
        $group->delete();

        return redirect('/groups')->with('success', 'Group deleted!');
    }
}
