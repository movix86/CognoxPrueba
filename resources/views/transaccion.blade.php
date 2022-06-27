@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Transacciones: ') }}
                    @if (isset($data))
                        @foreach ($data['origen'] as $item)
                            {{$item->name . " - " . "tu saldo: " . $item->saldo}}
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    @if (isset($data))
                        @component('components.transaccionView.formTransaccion', ['data'=>$data])
                            <x-transaccionView.formTransaccion/>
                        @endcomponent
                    @endif
                </div>
            </div>
            <div>
                <p>*No tienen cuentas a donde tranferir?</p>
                <p>#Tienen que registrarla abajo.</p>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <br>
                    <a href="{{url('/usuarios')}}">Usuarios registrados de prueba</a>
                </div>
                <div class="col-sm-4">
                    <br>
                    <a href="{{url('/abrir-registrar-cuenta')}}">Registrar Cuentas para transferir</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
