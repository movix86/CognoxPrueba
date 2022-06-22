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

class TransaccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function transaccion(){
        $user=Auth::user()->id;
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $origen = Accounts::where('user_id', $user)->get();

        return view('transaccion', ['data'=>$origen]);
    }

    public function enviado(Request $request, SendFormValidator $sendFormValidator){

        $data['origen'] = $request->input('origen');
        $data['cantidad'] = $request->input('cantidad');
        $data['destino'] = $request->input('destino');

        $cuentaDestino = Accounts::where('cuenta', $data['destino'])->first();
        $cuentaOrigen = Accounts::where('cuenta', $data['origen'])->first();
        // var_dump($saveTransaction->cuenta);
        // die();
        if ($data['origen'] == $cuentaDestino->cuenta){
            return back()->with('error','No puedes enviar dinero a tu cuenta!');
        }elseif($cuentaOrigen->saldo <= 0){
            return back()->with('error','No cuenta con suficiente saldo!');
        }else{
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

    public function guardarc(Request $request, CreateFormValidator $createformvalidator){

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['cuenta'] = $request->input('cuenta');
        $data['saldo'] = $request->input('saldo');


        $user = User::where('email', $data['email'])->first();
        if ($user == NULL) {
            return back()->with('error','Este usuarios no existe. debe registrarlo!');
        }else{
            $cuenta = new Accounts;
            $cuenta->name = $data['name'];
            $cuenta->email = $data['email'];
            $cuenta->cuenta = $data['cuenta'];
            $cuenta->saldo = $data['saldo'];
            $cuenta->user_id = $user->id;
            $cuenta->save();
        }
        return back()->with('success','Cuenta creada!');
    }

    public function crearu(){
        return view('crearUsuario');
    }

    public function guardaru(Request $request, CreateUserValidator $createuservalidator){

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['documento'] = $request->input('documento');
        $data['clave'] = Hash::make($request->input('password'));
        if (User::where('email', $data['email'])->first() || User::where('documento', $data['documento'])->first()) {
            return back()->with('error','Este usuarios ya existe');
        }


        $user = User::where('email', $data['email'])->first();
        if ($user == NULL) {
            $cuenta = new User;
            $cuenta->name = $data['name'];
            $cuenta->email = $data['email'];
            $cuenta->documento = $data['documento'];
            $cuenta->password = $data['clave'];
            $cuenta->save();
            return back()->with('success','Este usuario fue creado, ahora puede crearle cuenta de pago!');
        }
    }
}
