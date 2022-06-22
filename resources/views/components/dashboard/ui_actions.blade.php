<div class="row">
    <h5>Readme App:
        <small>
            Esta Aplicacion funciona con 3 botones. El primero es para hacer envios, el segundo para registrar usuario y el tercero para crear cuenta de usuario.
        </small>
    </h5>
    <hr>
    <h5>Readme App:
        <small>
            Para crear una cuenta, debe primero crear el usuario.
        </small>
    </h5>
</div>
<div class="row">
    <div class="col p-3 bg-light text-white btnCenter"><a href="{{url('/transaccion')}}"><i class="fa fa-money" style="font-size:34px"></i> <br> Transacciones</a></div>
    <div class="col p-3 bg-light text-white btnCenter"><a href="{{url('/crearc')}}"> <i class="fa fa-desktop" style="font-size:34px"></i><br>Crear cuenta</a></div>
    <div class="col p-3 bg-light text-white btnCenter"><a href="{{url('/crearu')}}"><i class="fa fa-user-plus" style="font-size:34px"></i> <br> Crear Usuario</a></div>
    {{-- <button onclick="alerta()">Alerta</button> --}}
</div>
