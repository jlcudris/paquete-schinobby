<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\UserRole;
use App\RolePermission;
use App\User;
use App\UserPermission;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        //obtenemso el usuario logueado
        $user = User::find(Auth::id());

        //obtenemos el registro del permiso que se inyecto como parametro al middleware
        $current_permission = Permission::where('slug', $permission)->first();

        //si existe un suario logueado
        if($user){
            //obetnemos todo los roles del usuario logueado en ese momento
            $user_roles = UserRole::where('user_id', $user->id)->get();

            //validamos si nos trajo algun rol
            if(count($user_roles) > 0){

                //recorremos todos sus roles
                foreach ($user_roles as $user_role) {

                    //para cada roll que tenga el usuario  traeremos los permisos asociados al roll que tine asignado
                    //por defecto user_role seran los roles del user logueado

                    $role_permissions = RolePermission::where('role_id', $user_role->role_id)
                    ->where('permission_id', $current_permission->id)->first();

                    $user_permissions = UserPermission::where('user_id',$user->id)
                    ->where('permission_id', $current_permission->id)->first();

                    if($role_permissions){
                            return $next($request);

                    }else if($user_permissions){

                            return $next($request);

                    }else{

                        return response()->json(['NoAutorizado' => 'No tienes el permiso para acceder a  este modulo'], 401);
                    }

                }
            }else{
                return response()->json(['UserNoroles' => 'este usario no tiene roles asignado por favor verificar'], 401);
            }
        }else{
            return response()->json(['Error' => 'No tienes permiso a esta ruta o estas intentado acceder con credenciales invalidas'], 404);
        }


    }
}
