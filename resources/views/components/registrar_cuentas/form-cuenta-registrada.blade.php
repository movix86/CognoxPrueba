<form action="{{ url('/registrar-cuenta') }}" method="POST">
    @csrf

    {{--INCLUDE FUNCIONA PARA GUARDADO EXITOSO--}}
@include('flash-message')
    <div class="form-group">
        <label for="cuenta">#Cuenta</label>
        <input type="number" class="form-control" id="cuenta" name="cuenta" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Escribe tu cuenta y recuerdala.</small>
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

