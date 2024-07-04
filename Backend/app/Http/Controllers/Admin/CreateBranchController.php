<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreateBranch;
use Illuminate\Http\Request;

class CreateBranchController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('role_or_permission:CreateBranch access|CreateBranch create|CreateBranch edit|CreateBranch delete', ['only' => ['index','show']]);
        // $this->middleware('role_or_permission:CreateBranch create', ['only' => ['create','store']]);
        // $this->middleware('role_or_permission:CreateBranch edit', ['only' => ['edit','update']]);
        // $this->middleware('role_or_permission:CreateBranch delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $branches = CreateBranch::paginate(4);

        // return view('branchs.index', compact('branchs'));

        return view('branch.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
        dd($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
