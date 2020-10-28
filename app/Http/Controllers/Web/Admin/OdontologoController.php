<?php

namespace App\Http\Controllers\Web\Admin;

use App\Odontologo;
use Illuminate\Http\Request;
use App\User;
use App\Especialidade;
use App\Http\Controllers\Controller;

class OdontologoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $odontologos = User::odontologos()->paginate();
        return view('administrador.odontologos.index', compact('odontologos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $especialidades = Especialidade::all();
        return view('administrador.odontologos.crear', compact('especialidades'));
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
            'cedula' => 'digits:8',
            'password' => 'required'

        ];

        $this->validate($request, $rules);

        $user = User::create(
            $request->only('name','email','cedula')
                + [
                    'rol' => 'odontologo',
                    'password' => bcrypt($request->input('password'))
                ]
            );

        $user->especialidades()->attach($request->input('especialidad'));

        $notificacion = 'El odontólogo se ha registrado correctamente.';
        return redirect('/odontologos')->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Odontologo  $odontologo
     * @return \Illuminate\Http\Response
     */
    public function show(Odontologo $odontologo)
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
        $especialidades = Especialidade::all();
        $odontologo = User::odontologos()->findOrFail($id);

        $especialidad_ids = $odontologo->especialidades()->pluck('especialidades.id');
        return view('administrador.odontologos.editar', compact('odontologo','especialidades','especialidad_ids'));
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
            'cedula' => 'digits:8',
        ];

        $this->validate($request, $rules);

        $user = User::odontologos()->findOrFail($id);
        $data = $request->only('name','email','cedula');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $user->especialidades()->sync($request->input('especialidad'));

        $notificacion = 'El odontólogo se ha actualizado correctamente.';
        return redirect('/odontologos')->with(compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Odontologo  $odontologo
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $odontologo)
    {
        //
        $notificacion= 'El odontólogo "'. $odontologo->name .'" se ha eliminado correctamente.';
        $odontologo->delete();

        
        
        return redirect('/odontologos')->with(compact('notificacion'));
    }
}
