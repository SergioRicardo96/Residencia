<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Especialidade;
// 
use Rediret,Response;
use App\Http\Controllers\Controller;

class EspecialidadeController extends Controller
{
    
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $especialidades = Especialidade::paginate();
        return view('administrador.especialidad.index',compact('especialidades'));
    }

    public function create()
    {
    	return view('administrador.especialidad.crear');
    }

    public function store(Request $request)
    {
        $this->validar($request);
    	
    	$especialidad = new Especialidade();
    	$especialidad->nombre = $request->input('nombre');
    	$especialidad->descripcion = $request->input('descripcion');
    	$especialidad->save();

        $notificacion= 'La especialidad se ha creado correctamente.';
    	return redirect('/especialidades')->with(compact('notificacion'));
    }

    public function edit(Especialidade $especialidade)
    {
        return view('administrador.especialidad.editar',compact('especialidade'));
    }


    public function update(Request $request, Especialidade $especialidade)
    {
        $this->validar($request);
    	$especialidade->nombre = $request->input('nombre');
    	$especialidade->descripcion = $request->input('descripcion');
    	$especialidade->save();

        $notificacion= 'La especialidad se ha actualizado correctamente.';
        return redirect('/especialidades')->with(compact('notificacion'));
    }

    public function destroy(Especialidade $especialidade)
    {
        $notificacion= 'La especialidad "'. $especialidade->nombre .'" se ha eliminado correctamente.';

        $especialidade->delete();
        
        return redirect('/especialidades')->with(compact('notificacion'));
    }

    private function validar(Request $request)
    {
        $rules = [
            'nombre' => 'required|min:1',
        ];
        $messages = [
            'nombre.required' => 'Es necesario ingresar un nombre.',
            'nombre.min' => 'Como minimo el nombre debe tener 1 caracter.',
        ];

        $this->validate($request, $rules, $messages);
    }
}
