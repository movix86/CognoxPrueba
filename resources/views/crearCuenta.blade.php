@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            {{ __('Habilitar cuenta para transferencias: ') }}
                        </div>
                        <div class="col-sm-6">
                            <a href="{{url('/crearu')}}">Registrar usuario</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <x-transaccionView.formCuenta/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
