<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

public function index()
{
	$groups = Group::latest()->paginate(5);
	return view('groups.index',compact('groups'))
	->with('i',(request()->input('page', 1)-1)*5);
}

public function create()
{
	return view('group.create');
}

    public function store(Request $request)
    {
    	$request->validate([
    		'groupname' => 'required',
    	    'slots' => 'required',
    	    'members' => 'required',
    	]);

    	Group::create($request->all());

    	return redirect()->route('groups.index')
    	->with('success', 'Group created successfully.');
    }

    public function show(Group $group)
    {
    	return view('groups.show', compact('group'));
    }

    public function edit(Student $student)
    {
    	return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Student $student)
    {
    	$request->validate([
    	]);

    	$student->update($request->a());

    	return redirect()->route('groups.index')
    	->with('success', 'Group updated successfully');
    }

    public function destroy(Group $group)
    {
    	$group->delete();

    	return redirect()->route('groups.index')
    	->with('success', 'Group deleted successfully');
    }
}
