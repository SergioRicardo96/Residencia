<?php

namespace App\Http\Controllers\Web\Admin;

use App\Administrador;
use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $administradores = User::administradores()->paginate();
        return view('administrador.admins.index', compact('administradores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.admins.crear');
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
        //
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];

        $this->validate($request, $rules);

        User::create(
            $request->only('name','email')
                + [
                    'rol' => 'admin',
                    'password' => bcrypt($request->input('password'))
                ]
            );

        $notificacion = 'El administrador se ha registrado correctamente.';
        return redirect('/administradores')->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $administradores = User::administradores()->findOrFail($id);
        return view('administrador.admins.editar', compact('administradores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'name' => 'required',
        ];

        $this->validate($request, $rules);

        $user = User::administradores()->findOrFail($id);
        $data = $request->only('name','email');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notificacion = 'El administrador se ha actualizado correctamente.';
        return redirect('/administradores')->with(compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $administradore)
    {
        //
        $notificacion= 'El administrador "'. $administradore->name .'" se ha eliminado correctamente.';
        $administradore->delete();

        
        
        return redirect('/administradores')->with(compact('notificacion'));
    }
}
