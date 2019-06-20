<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//include(app_path().'\..\vendor\cloudinary\autoload.php');
class LoginController extends Controller
{
    private $client;

    public function __construct()
    {
        //obtener el clinete del auth en este caso el #1 ira aouth_client en la base de datos(Cliente julienne)
        $this->client = Client::find(1);
    }

    //login de usuario
    public function login(Request $request)
    {

        $validator=\Validator::make($request->all(),[
    		'username' => 'required|email',
    		'password' => 'required|min:6',

        ]);

        if($validator->fails())
        {

          return response()->json( $errors=$validator->errors()->all(), 401);
        }
        else
        {
            //validar que el usuario exista
            $user=DB::table('users as u')->where('u.email',request('username'))
            ->first();
            if($user != null){
                //hashear la contraseña y validar
                if (Hash::check(request('password'), $user->password)) {
                    DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();

                    $validar_token = DB::table('oauth_access_tokens')->where('user_id', $user->id)->first();
                    //agregar parametros al request
                    $params = [
                        'grant_type' => 'password',
                        'client_id' => $this->client->id,
                        'client_secret' => $this->client->secret,
                        'username' => request('username'),
                        'password' => request('password'),
                        'scope' => '*'
                    ];
                    //agregar parametros al request
                    $request->request->add($params);
                    $proxy = Request::create('oauth/token', 'POST');

                    return Route::dispatch($proxy);
            }else{
                return response()->json(['message' => 'Usuario o contraseña incorrectas'], 401);
            }
        }else{
            return response()->json(['message' => 'Usuario no encontrado'], 401);
        }

        }
    }
}
