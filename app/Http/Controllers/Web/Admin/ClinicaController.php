<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Clinica;
// 
use Rediret,Response;
use App\Http\Controllers\Controller;

class ClinicaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $clinicas = Clinica::paginate();
        return view('administrador.clinicas.index',compact('clinicas'));
    }

    public function create()
    {
    	return view('administrador.clinicas.crear');
    }

    public function store(Request $request)
    {
        $this->validar($request);
    	
    	$clinica = new Clinica(); 
    	$clinica->nombre = $request->input('nombre');
    	$clinica->sucursal = $request->input('sucursal');
    	$clinica->save();

        $notificacion= 'La clinica se ha creado correctamente.';
    	return redirect('/clinicas')->with(compact('notificacion'));
    }

    public function edit(Clinica $clinica)
    {
        return view('administrador.clinicas.editar',compact('clinica'));
    }


    public function update(Request $request, Clinica $clinica)
    {
        $this->validar($request);
    	$clinica->nombre = $request->input('nombre');
    	$clinica->sucursal = $request->input('sucursal');
    	$clinica->save();

        $notificacion= 'La clinica se ha actualizado correctamente.';
        return redirect('/clinicas')->with(compact('notificacion'));
    }

    public function destroy(Clinica $clinica)
    {
        $notificacion= 'La clinica "'. $clinica->nombre .'" se ha eliminado correctamente.';

        $clinica->delete();
        
        return redirect('/clinicas')->with(compact('notificacion'));
    }

    private function validar(Request $request)
    {
        $rules = [
            'nombre' => 'required|min:1',
            'sucursal' => 'required|min:1',
        ];
        $messages = [
            'nombre.required' => 'Es necesario ingresar un nombre.',
            'nombre.min' => 'Como minimo el nombre debe tener 1 caracter.',
            'sucursal.min' => 'Como minimo la sucursal debe tener 1 caracter.',
            'sucursal.required' => 'Es necesario ingresar una sucursal.',
        ];

        $this->validate($request, $rules, $messages);
    }
}
