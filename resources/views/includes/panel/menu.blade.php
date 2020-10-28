<!-- Navigation -->
<h6 class="navbar-heading text-muted">
  @if (auth()->user()->rol == 'admin')
Gestionar Datos
@else
Menú
@endif
</h6>
<ul class="navbar-nav">
  @if (auth()->user()->rol == 'admin')
  <li class="nav-item">
    <a class="nav-link" href="{{ url('administradores') }}">
      <i class="ni ni-tv-2 text-primary"></i> Adminitradores
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('clinicas') }}">
      <i class="ni ni-planet text-blue"></i> Clinicas
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('especialidades') }}">
      <i class="ni ni-pin-3 text-orange"></i> Especialidades
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('odontologos') }}">
      <i class="ni ni-single-02 text-yellow"></i> Odontólogos
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('recepcionistas') }}">
      <i class="ni ni-bullet-list-67 text-red"></i> Recepcionistas
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25 text-info"></i> Cerrar sesión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout"> 
      @csrf
    </form>
  </li>
  @elseif (auth()->user()->rol == 'odontologo')
  <li class="nav-item">
    <a class="nav-link" href="/home">
      <i class="ni ni-tv-2 text-primary"></i> Gestionar Horario
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="clinicas">
      <i class="ni ni-planet text-blue"></i> Mis citas
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="especialidades">
      <i class="ni ni-pin-3 text-orange"></i> Mis pacientes
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25 text-info"></i> Cerrar sesión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout"> 
      @csrf
    </form>
  </li>
  @else 
  {{-- recepcionista --}}
  <li class="nav-item">
    <a class="nav-link" href="clinicas">
      <i class="ni ni-planet text-blue"></i> Reservar cita
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="especialidades">
      <i class="ni ni-pin-3 text-orange"></i> Mis citas
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25 text-info"></i> Cerrar sesión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout"> 
      @csrf
    </form>
  </li>

  @endif
</ul>

<!-- Divider -->
@if (auth()->user()->rol == 'admin')
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
      <i class="ni ni-spaceship"></i> Frecuencia de citas
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
      <i class="ni ni-palette"></i> Medicos más activos
    </a>
  </li>
</ul>
@endif