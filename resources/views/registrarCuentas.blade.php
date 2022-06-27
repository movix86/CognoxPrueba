@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            {{ __('Registrar cuenta para transferencias: ') }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <x-registrar_cuentas.form-cuenta-registrada/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
