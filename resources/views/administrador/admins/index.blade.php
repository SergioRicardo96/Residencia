@extends('layouts.panel')

@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">administradores: {{ $administradores->total() }} registros | página {{ $administradores->currentPage() }} de {{ $administradores->lastPage() }}</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('administradores/create') }}" class="btn btn-sm btn-success">Nueva odontólogo</a>
      </div>
    </div>
  </div>
  @if(session('notificacion'))
    <div class="card-body">
      <div class="alert alert-success" role="alert">
        {{ session('notificacion') }}
      </div>
    </div>
  @endif
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($administradores as $admin)
        <tr>
          <th scope="row">
            {{ $admin->name }}
          </th>
          <td>
            {{ $admin->email }}
          </td>
          <td>
            <a href="{{ url('administradores/'.$admin->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>

            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#el{{$admin->id}}">Eliminar
            </button>
          </td>
        </tr>

        <!-- modal para eliminar un elemento -->
        <div class="modal fade" id="el{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
              <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Se requiere su atención.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            
              <div class="modal-body">
                <div class="py-3 text-center">
                  <i class="ni ni-bell-55 ni-3x"></i>
                  <h4 class="heading mt-4">Debe de leer lo siguiente!</h4>
                  <p>¿Esta seguro que desea eliminar "{{ $admin->name }}"?</p>
                </div> 
              </div>
            
              <div class="modal-footer">
                <form action="{{ url('/administradores/'.$admin->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                    <button type="submit" class="btn btn-white">Ok, Adelante</button>
                </form>
               
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        @endforeach
      </tbody>
    </table>
    <div class="card-body">
      {!! $administradores->render() !!}
    </div>
  </div>
</div>

@endsection




@section('script')

@endsection