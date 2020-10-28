<?php

namespace App\Http\Controllers\Web\Admin;

use App\Recepcionista;
use Illuminate\Http\Request;

use App\User;
use App\Http\Controllers\Controller;

class RecepcionistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $recepcionistas = User::recepcionistas()->paginate();
        return view('administrador.recepcionistas.index', compact('recepcionistas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administrador.recepcionistas.crear');
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'

        ];

        $this->validate($request, $rules);

        User::create(
            $request->only('name','email')
                + [
                    'rol' => 'recepcionista',
                    'password' => bcrypt($request->input('password'))
                ]
            );

        $notificacion = 'La recepcionista se ha registrado correctamente.';
        return redirect('/recepcionistas')->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Odontologo  $odontologo
     * @return \Illuminate\Http\Response
     */
    public function show(Recepcionista $recepcionista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Odontologo  $odontologo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $recepcionista = User::recepcionistas()->findOrFail($id);
        return view('administrador.recepcionistas.editar', compact('recepcionista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Odontologo  $odontologo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
        ];

        $this->validate($request, $rules);

        $user = User::recepcionistas()->findOrFail($id);
        $data = $request->only('name','email');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notificacion = 'La recepcionista se ha actualizado correctamente.';
        return redirect('/recepcionistas')->with(compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Odontologo  $odontologo
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $recepcionista)
    {
        //
        $notificacion= 'La recepcionista "'. $recepcionista->name .'" se ha eliminado correctamente.';
        $recepcionista->delete();

        
        
        return redirect('/recepcionistas')->with(compact('notificacion'));
    }
}
