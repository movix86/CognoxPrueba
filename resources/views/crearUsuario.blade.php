@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            {{ __('Registrar usuario: ') }}
                        </div>
                        <div class="col-sm-6">
                            <a href="{{url('/crearc')}}">*Habilitar cuenta de este usuario</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <x-transaccionView.formUsuario/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
