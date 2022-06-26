<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendFormValidator;
use App\Http\Requests\CreateFormValidator;
use App\Http\Requests\CreateUserValidator;
use App\Models\User;
use App\Models\Accounts;
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
        $origen = Accounts::where('user_id', $user)->get();

        return view('transaccion', ['data'=>$origen]);
    }

    public function enviado(Request $request, SendFormValidator $sendFormValidator){

        $data['origen'] = $request->input('origen');
        $data['cantidad'] = $request->input('cantidad');
        $data['destino'] = $request->input('destino');

        $cuentaDestino = Accounts::where('cuenta', $data['destino'])->first();
        $cuentaOrigen = Accounts::where('cuenta', $data['origen'])->first();
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


        $cuentaDestino->save();
        $cuentaOrigen->save();
        return back()->with('success','Tu envio ha sido realizado!');
    }

    public function crearc(){
        return view('crearCuenta');
    }

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
            'user_id'=>$accounts->id,
        ]);

    }

    public function estado(){
        $user=Auth::user()->id;
        $data = User::select(
            'users.name',
            'users.documento',
            'accounts.cuenta',
            'accounts.saldo',
            )->leftjoin('accounts', 'accounts.user_id', '=', 'users.id',)->where('users.id', '=', trim($user))->get();

        $origen = Accounts::where('user_id', $user)->get();
        return view('estado_cuenta', ['data' => $data]);
    }
}
