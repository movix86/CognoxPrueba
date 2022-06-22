<form action="{{ url('guardarc') }}" method="POST">
    @csrf

    {{--INCLUDE FUNCIONA PARA GUARDADO EXITOSO--}}
@include('flash-message')
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Escribe tu nombre. tiene que ser exacto.</small>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Escribe tu email correcto. recuerdalo y no lo olvides.</small>
      </div>
      <div class="form-group">
        <label for="cuenta">#Cuenta</label>
        <input type="number" class="form-control" id="cuenta" name="cuenta" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Escribe tu cuenta y recuerdala.</small>
      </div>
      <div class="form-group">
        <label for="saldo">#Saldo</label>
        <input type="number" class="form-control" id="saldo" name="saldo" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Escribe un saldo, esta app es de prueba.</small>
      </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<br>
<br>
{{--ERRORS FUNCIONA PARA VALIDACION DE CAMPOS CON UN REUQEST--}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

