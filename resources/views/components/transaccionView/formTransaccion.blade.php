<form action="{{ route('enviado') }}" method="POST">
    @csrf

    <div class="container">
        <h3>Envia dinero</h3>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Cuenta de origen</th>
              <th>a</th>
              <th>Cuenta de destino</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <select class="form-control" name="origen" id="origen">
                    <option>Cuenta Origen</option>
                    @if (isset($data))
                        @foreach ($data as $item)
                            <option value="{{$item->cuenta}}">{{$item->cuenta}}</option>
                        @endforeach
                    @endif
                </select>
              </td>
              <td>Envias a:</td>
              <td>
                <div class="form-group">
                    <input type="number" class="form-control form-control" id="destino" name="destino">
                </div>
              </td>
              <td>
                <div class="form-group">
                    <input type="number" class="form-control form-control" id="cantidad" name="cantidad">
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <button type="submit" class="btn btn-success"><i class="fa fa-send-o" style="font-size:17px"></i> Transferir</button>

      <br>
      <br>
      {{--INCLUDE FUNCIONA PARA GUARDADO EXITOSO--}}
      @include('flash-message')
      {{--ERRORS FUNCIONA PARA VALIDACION DE CAMPOS CON UN REUQEST--}}
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
</form>
