@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Nuevo odontólogo</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('odontologos') }}" class="btn btn-sm btn-danger">Cancelar y volver
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
    <form action="{{ url('odontologos') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>
      <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>
      <div class="form-group">
        <label for="cedula">Cedúla</label>
        <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}" required minlength="8" maxlength="8">
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="text" name="password" class="form-control" value="Bioart" required minlength="6">
      </div>
      <div class="form-group">
        <label for="especialidad">Especialidades</label>
        <select name="especialidad[]" id="especialidad" class="form-control selectpicker" data-style="btn-outline-info" multiple title="Selecione una o varias">
          @foreach($especialidades as $espe)
          <option value="{{ $espe->id }}"> {{ $espe->nombre }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-info">
        Guardar
      </button>
    </form>
  </div>
</div>

@endsection




@section('script')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

@endsection