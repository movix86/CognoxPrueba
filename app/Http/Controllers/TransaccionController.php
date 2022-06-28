<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendFormValidator;
use App\Http\Requests\CreateFormValidator;
use App\Http\Requests\CreateUserValidator;
use App\Models\User;
use App\Models\Accounts;
use App\Models\Pagos;
use App\Models\CuentasRegistradas;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class TransaccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function usuariosFinales(){

        $data = User::select(
            'users.id',
            'users.name',
            'users.documento',
            'accounts.cuenta',
            'accounts.saldo',
            )->leftjoin('accounts', 'accounts.user_id', '=', 'users.id',)->simplePaginate(5);
        return view('usuarios_finales', ['data'=>$data]);
    }
    public function transaccion(){
        $user=Auth::user()->id;
        // $origen = Accounts::where('user_id', $user)->get();
        // $destino = CuentasRegistradas::where('user_origin_id', $user)->get();
        if (empty($user)) {
            return redirect('/login');
        }else{
            $data = Accounts::select(
                'accounts.name',
                'accounts.cuenta',
                'accounts.user_id',
                'cuentasregistradas.account_target',
                'cuentasregistradas.user_origin_id',
                'cuentasregistradas.user_target_id'
                )->join('cuentasregistradas', 'cuentasregistradas.user_origin_id', '=', 'accounts.user_id')->where('accounts.user_id', $user)->get();
        }
        return view('transaccion');
    }

    #ENVIOS
    public function enviado(Request $request, SendFormValidator $sendFormValidator){

        $data['origen'] = $request->input('origen');
        $data['cantidad'] = $request->input('cantidad');
        $data['destino'] = $request->input('destino');
        $data['user_id'] = Auth::user()->id;

        $cuentaDestino = Accounts::where('cuenta', $data['destino'])->first();
        $cuentaOrigen = Accounts::where('cuenta', $data['origen'])->first();
        $data['destino_user_id'] = $cuentaDestino['id'];
        // var_dump($cuentaDestino);
        // die();
        if($cuentaOrigen->saldo <= 0){
            return back()->with('error','No cuenta con suficiente saldo!');
        }
        if ($cuentaDestino == NULL) {
            return back()->with('error','La cuena de destino no existe!');
        }
        if ($data['origen'] == $cuentaDestino['cuenta']){
            return back()->with('error','No puedes enviar dinero a tu cuenta!');
        }else if ($data['origen'] !== $cuentaDestino->cuenta){
            $cuentaDestino->saldo = $cuentaDestino->saldo + $data['cantidad'];
            $cuentaOrigen->saldo = $cuentaOrigen->saldo - $data['cantidad'];
        }

        $this->logsend($data);
        $cuentaDestino->save();
        $cuentaOrigen->save();
        return back()->with('success','Tu envio ha sido realizado!');

    }

    public function logsend($data){
        Pagos::forceCreate([
            'origen'=>$data['origen'],
            'destino'=>$data['destino'],
            'envio'=>$data['cantidad'],
            'status'=>300.00,
            'user_id'=>$data['user_id'],
            'accounts_id'=>$data['destino_user_id'],
        ]);
    }

    public function log(){
        $data = Pagos::all();
        return view('log', ['data'=>$data]);
    }

    public function crearc(){
        return view('crearCuenta');
    }
    #CREAR USUARIO Y CREAER CUENTAS
    public function crearu(){
        return view('crearUsuario');
    }
    public function guardaru(Request $request, CreateUserValidator $createuservalidator){

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['documento'] = $request->input('documento');
        $data['password'] = Hash::make($request->input('password'));
        if (User::where('email', $data['email'])->first() || User::where('documento', $data['documento'])->first()) {
            return back()->with('error','Este usuarios ya existe');
        }
        tap(User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'documento' => $request->input('documento'),
            'password' => Hash::make($request->input('password')),
        ]),function($accounts){
            $this->guardarc($accounts);
        });
        return back()->with('success','Cuenta creada con exito');
    }

    public function guardarc($accounts){
        $cuenta = rand(5,500000000000);
        Accounts::forceCreate([
            'name'=>$accounts->name,
            'email'=>$accounts->email,
            'cuenta'=>$cuenta,
            'saldo'=>300.00,
            'estado'=>'activa',
            'user_id'=>$accounts->id,
        ]);

    }

    #REGISTRAR CUENTAS PARA ENVIOS
    public function abrirRegistrarCuenta(){
        return view('registrarCuentas');
    }
    public function registrarCuenta(Request $request){
        $cuenta = $request->input('cuenta');
        $data = Accounts::where('cuenta', '=', trim($cuenta))->first();
        $yaregistrada = CuentasRegistradas::where('account_target', trim($cuenta))->first();
        $micuenta = Accounts::where('user_id', Auth::user()->id)->first();

        #Si no existe
        if (empty($data)) {
            return back()->with('error','Este usuario o cuenta no existe');
        }
        #Ya esta registrada
        if ($yaregistrada) {
            return back()->with('error','Este usuario o cuenta ya esta registrado');
        }

        #no se puede registrar a si mismo
        if ($cuenta == $micuenta['cuenta']) {
            return back()->with('error','No puede registrar su propia cuenta');
        }else{
            CuentasRegistradas::Create([
                'user_origin_id' => Auth::user()->id,
                'user_target_id' => $data["user_id"],
                'account_target' => $data["cuenta"],
            ]);
        }
            return back()->with('success','Cuenta registrada con exito');

    }

    public function estado(){
        $user=Auth::user()->id;
        $data = User::select(
            'users.name',
            'users.documento',
            'accounts.cuenta',
            'accounts.saldo',
            )->leftjoin('accounts', 'accounts.user_id', '=', 'users.id',)->where('users.id', '=', trim($user))->get();
        // var_dump($data);
        // die();
        return view('estado_cuenta', ['data' => $data]);
    }
}
