<div class="container">
    @if (isset($data))
        <strong><p>Hay usuarios registrados <i class="fa fa-check" style="font-size:20px;color:rgb(16, 82, 0)"></i><p></strong>
    @else
        <strong><p>*Solo tu estas registrado crea otro: <a href="{{url('/crearu')}}">Aqui!</a><i class="fa fa-remove" style="font-size:20px;color:red"></i></p><strong>
    @endif
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>#Cuenta</th>
                <th>#Saldo</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($data))
                @foreach ($data as $item)
                    @if ($item->id === Auth::user()->id)
                        <tr>
                            <td>{{$item->name . ' (Tu)'}}</td>
                            <td>{{$item->documento}}</td>
                            <td>{{($item->cuenta!== null) ? $item->cuenta : 'Debe habilitar cuenta'}}</td>
                            <td>{{($item->saldo !== null) ? $item->saldo : 'Debe habilitar cuenta'}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->documento}}</td>
                            <td>{{($item->cuenta!== null) ? $item->cuenta : 'Debe habilitar cuenta'}}</td>
                            <td>{{($item->saldo !== null) ? $item->saldo : 'Debe habilitar cuenta'}}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
    <br>
    @if (isset($data))
        {{ $data->onEachSide(5)->links() }}
    @endif
</div>

{{-- <div class="container">
    @if (isset($data))
        @foreach ($data as $user)
            {{ $user->name }}
        @endforeach
    @endif
</div> --}}
{{-- @if (isset($data))
{{ $data->links() }}
@endif --}}
