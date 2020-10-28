@extends('layouts.panel')

@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Editar especialidad</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('especialidades') }}" class="btn btn-sm btn-danger">Cancelar y volver
        </a>
      </div>
    </div>
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form action="{{ url('especialidades/'.$especialidade->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $especialidade->nombre) }}" required>
      </div>
      <div class="form-group">
        <label for="name">Descripción</label>
        <input type="text" name="descripcion" class="form-control" value="{{ old('sucursal', $especialidade->descripcion) }}">
      </div>
      <button type="submit" class="btn btn-info">
        Guardar
      </button>
    </form>
  </div>
</div>

@endsection




@section('script')

@endsection