@extends('layouts.panel')

@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Editar recepcionista</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('recepcionistas') }}" class="btn btn-sm btn-danger">Cancelar y volver
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
    <form action="{{ url('recepcionistas/'.$recepcionista->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $recepcionista->name) }}" required>
      </div>
      <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $recepcionista->email) }}" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="text" name="password" class="form-control" value="" minlength="6">
        <p>Ingrese un valor solo si desea modificar la contraseña</p>
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