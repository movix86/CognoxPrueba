<div class="row">
    <h5>Bienvenido Señor/a
        @if (isset($data))
            {{$data['name']}}
        @endif
        <small>
            Se encuentra en su <i class="fa fa-check" style="font-size:20px;color:rgb(16, 82, 0)"></i>
        </small>
    </h5>
    <hr>
    {{-- <h5>Paso2:
        <small>
            Habilitar cuenta para transferencia<a href="{{url('/crearc')}}">Aqui!</a>.
        </small>
    </h5>
    <hr>
    <h5>Nota:
        <small>
            Repita los dos pasos anteriores para crear un usuario diferente y enviarle dinero.
        </small>
    </h5> --}}
</div>
<div class="row">
    <div class="col p-3 bg-light text-white btnCenter"><a href="{{url('/transaccion')}}"><i class="fa fa-money" style="font-size:34px"></i> <br> Transacciones</a></div>
    <div class="col p-3 bg-light text-white btnCenter"><a href="{{url('/estado')}}"> <i class="fa fa-cogs" style="font-size:36px"></i><br>Estado de su cuenta</a></div>
    <div class="col p-3 bg-light text-white btnCenter"><a href="{{url('/abrir-registrar-cuenta')}}"> <i class="fa fa-desktop" style="font-size:34px"></i><br>Registrar cuenta</a></div>
    {{-- <div class="col p-3 bg-light text-white btnCenter"><a href="{{url('/crearu')}}"><i class="fa fa-user-plus" style="font-size:34px"></i> <br> Crear Usuario</a></div> --}}
    {{-- <button onclick="alerta()">Alerta</button> --}}
</div>
