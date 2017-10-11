<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $roles = Role::all();
        return view('user.index', compact('user', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $tambah = new User();
        $tambah->name = $request['nama'];
        $tambah->email = $request['email'];
        $tambah->password = $request['password'];
        $tambah->save();
        return redirect()->to('/user');
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
        $show = User::find($id);
        $roles = Role::all();
        return view('user.detail',compact('show', 'roles'));
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
        $update = User::where('id', $id)->first();
        $update->name = $request['name'];
        $update->email = $request['email'];
        $update->update();
        return redirect()->to('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = User::find($id);
        $hapus->delete();
        return redirect()->to('/user');
    }
    
    public function makeUserRole($user, $role)
    {
        $ru = new RoleUser();
        $ru->user_id = $user;
        $ru->role_id = $role;
        $ru->save();
    }

    public function deleUserRole($user, $role)
    {
        $ru = RoleUser::where([
            ['user_id', '=', $user],
            ['role_id', '=', $role]]);
        $ru->delete();
    }
}
