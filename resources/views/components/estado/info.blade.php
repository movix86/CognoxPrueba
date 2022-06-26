<div class="container">
    @if (isset($data))
        @foreach ($data as $item)
            @if ($item->cuenta !== null)
                <strong><p>Esta cuenta ya esta habilitada <i class="fa fa-check" style="font-size:20px;color:rgb(16, 82, 0)"></i><p></strong>
            @else
                <strong><p>*Debe habilitar estar cuenta para transferencias: <a href="{{url('/crearc')}}">Aqui!</a><i class="fa fa-remove" style="font-size:20px;color:red"></i></p><strong>
            @endif
        @endforeach
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
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->documento}}</td>
                        <td>{{($item->cuenta!== null) ? $item->cuenta : 'Debe habilitar cuenta'}}</td>
                        <td>{{($item->saldo !== null) ? $item->saldo : 'Debe habilitar cuenta'}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
