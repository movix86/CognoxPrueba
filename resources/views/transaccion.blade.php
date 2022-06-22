@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Transacciones: ') }}
                    @if (isset($data))
                        @foreach ($data as $item)
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
        </div>
    </div>
</div>
@endsection
