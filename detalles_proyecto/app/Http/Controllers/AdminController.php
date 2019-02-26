<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = new Admin();
        $tipo_rol_1= $request->input('rol-1') ?? '';
        $tipo_rol_2= $request->input('rol-2') ?? '';
        $tipo_rol_3= $request->input('rol-3') ?? '';
        $tipo_rol_4= $request->input('rol-4') ?? '';
        $roles = $tipo_rol_1.','.$tipo_rol_2.','.$tipo_rol_3.','.$tipo_rol_4;
        $admin->rol = $roles;
        $admin->fill($request->all());
        $admin = DB::table('admin')->insert([
            'nombre'=>"$admin->nombre",
            'apellido'=>"$admin->apellido",
            'correo'=>"$admin->correo",
            'username'=>"$admin->username",
            'password'=>"$admin->password",
            'rol'=>"$admin->rol"
        ]);
        return redirect('/admin');
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
    }

    public function login() {
        return view('auth.login');
    }

    public function session(Request $req) {
        $admin = Admin::where('username', 'like', $req->username)
                        ->orWhere('correo', 'like', $req->username)->first();
        if ($admin) {
            if ($admin->password == $req->password) {
                $req->session()->put('usuario', $admin->id);
                return redirect('/');
            }
        }
    }

    public function logout(Request $req) {
        $req->session()->flush();
        return redirect('/');
    }
}
