<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
//        $users = User::all();
        $users = User::paginate(10);

        return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
//        @dd($request->all());
        $input= [];
        $input["name"]= $request['name'];
        $input['lastname']= $request['lastname'];
        $input['mobile']= $request['mobile'];
        $input['email']= $request['email'];
        $input['password']= Hash::make($request['password']);
        $input['is_admin']= $request['is_admin'];
        $input['is_staff']= $request['is_staff'];

        $user = User::Create($input);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        return view('admin.users.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('admin.users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $input= [];
        $input["name"]= $request['name'];
        $input['lastname']= $request['lastname'];
        $input['mobile']= $request['mobile'];
        $input['email']= $request['email'];
        $input['is_admin']= $request['is_admin'];
        $input['is_staff']= $request['is_staff'];
        $user->update($input);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
//        dd(Excel::download(new UsersExport, 'users.xlsx'));
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function importfile(){
        return view('admin.users.importfile');
    }
    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));
        return redirect('/')->with('success', 'All good!');
    }
}
