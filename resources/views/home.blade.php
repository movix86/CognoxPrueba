@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Bienvenido a su Banco') }}</strong>
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}
                    @if (isset($data))
                        @component('components.dashboard.ui_actions', ['data'=>$data])
                            <x-dashboard.ui_actions/>
                        @endcomponent
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <br>
                    <a href="{{url('/crearu')}}">Registrar otro usuario para transferencia prueba</a>
                </div>
                <div class="col-sm-4">
                    <br>
                    <a href="{{url('/usuarios')}}">Usuarios registrados de prueba</a>
                </div>
                <div class="col-sm-4">
                    <br>
                    <a href="{{url('/log')}}">Historial envios</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
