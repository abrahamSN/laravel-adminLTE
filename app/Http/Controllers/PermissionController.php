<?php

namespace App\Http\Controllers;

use App\Permission;
use App\PermissionRole;
use App\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $perms = Permission::all();
        return view('permission.index', compact('perms', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.tambah');
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
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
        ]);
        $tambah = new Permission();
        $tambah->name = $request['name'];
        $tambah->display_name = $request['display_name'];
        $tambah->description = $request['description'];
        $tambah->save();
        return redirect()->to('/permission');
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
        $show = Permission::find($id);
        return view('permission.detail',compact('show'));
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
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
        ]);
        $update = Permission::find($id);
        $update->name = $request['name'];
        $update->display_name = $request['display_name'];
        $update->description = $request['description'];
        $update->update();
        return redirect()->to('/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Permission::find($id);
        $hapus->delete();
        return redirect()->to('/permission');
    }

    public function makePermiRole($perm, $role)
    {
        $pr = new PermissionRole();
        $pr->permission_id = $perm;
        $pr->role_id = $role;
        $pr->save();
    }

    public function delePermiRole($perm, $role)
    {
        $pr = PermissionRole::where([
            ['permission_id', '=', $perm],
            ['role_id', '=', $role]]);
        $pr->delete();
    }
}
