<div class="container">
        <strong><p>Tus transacciones registrados<i class="fa fa-check" style="font-size:20px;color:rgb(16, 82, 0)"></i><p></strong>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#Cuenta Origen</th>
                <th>#Cuenta destino</th>
                <th>#Envio</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($data))
                @foreach ($data as $item)
                    <tr>
                        <td>{{$item->origen}}</td>
                        <td>{{$item->destino}}</td>
                        <td>{{$item->envio}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
