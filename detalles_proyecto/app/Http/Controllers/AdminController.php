<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
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
        $rol_1= $request->input('rol-1') ?? '';
        $rol_2= $request->input('rol-2') ?? '';
        $rol_3= $request->input('rol-3') ?? '';
        $rol_4= $request->input('rol-4') ?? '';
        $permisos = $rol_1.','.$rol_2.','.$rol_3.','.$rol_4;
        $admin->fill($request->all());
        $admin->fill([
            'contrasena' => md5($request->input('contrasena')),
            'permisos' => $permisos
        ]);
        $admin->save();
        return redirect('/');
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
        return view('admin.login');
    }

    public function session(LoginRequest $request) {
        $admin = Admin::where('usuario', 'like', $request->usuario)
        ->where('contrasena', 'like', md5($request->contrasena))->first();
        if ($admin) {
            $request->session()->put('usuario', $admin->id);
            return redirect('/');
        } else {
            return back()->withErrors(['message' => 'Usuario o contraseña incorrecto :('])
                         ->withInput(request(['usuario']));
        }
    }

    public function logout(Request $req) {
        $req->session()->flush();
        return redirect('/');
    }
}
