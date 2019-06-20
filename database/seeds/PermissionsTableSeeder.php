<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Users
        Permission::create([
            'name'        =>'Navegar Usuarios',
            'slug'        =>'users.index',
            'description' =>'lista y navega todo los usuarios del sistema'
        ]);

        Permission::create([
            'name'        =>'Ver detalle de usuario',
            'slug'        =>'users.show',
            'description' =>'ver el detalle de los usuarios'
        ]);

        Permission::create([
            'name'        =>'Edicion de usuarios',
            'slug'        =>'users.edit',
            'description' =>'editar cualquier dato de un usuario del sistema'
        ]);

        Permission::create([
            'name'        =>'Eliminar Usuario',
            'slug'        =>'users.destroy',
            'description' =>'Elimina cualquier usuario del sistema'
        ]);

        //Roles

        Permission::create([
            'name'        =>'Navegar Roles',
            'slug'        =>'roles.index',
            'description' =>'lista y navega todo los Roles del sistema'
        ]);

        Permission::create([
            'name'        =>'Ver detalle de un Roles',
            'slug'        =>'roles.show',
            'description' =>'ver el detalle de los Roles'
        ]);

        Permission::create([
            'name'        =>'Crear Roles',
            'slug'        =>'roles.store',
            'description' =>'Permite crear un rol'
        ]);

        Permission::create([
            'name'        =>'Edicion de Roles',
            'slug'        =>'roles.edit',
            'description' =>'editar cualquier dato de un rol del sistema'
        ]);

        Permission::create([
            'name'        =>'Eliminar Roles',
            'slug'        =>'roles.destroy',
            'description' =>'Elimina cualquier rol del sistema'
        ]);


        //Products

        Permission::create([
            'name'        =>'Navegar Productos',
            'slug'        =>'products.index',
            'description' =>'lista y navega todo los productos del sistema'
        ]);

        Permission::create([
            'name'        =>'Ver detalle un producto',
            'slug'        =>'products.show',
            'description' =>'ver el detalle de los Productos'
        ]);

        Permission::create([
            'name'        =>'Crear Productos',
            'slug'        =>'products.store',
            'description' =>'Permite crear un producto'
        ]);

        Permission::create([
            'name'        =>'Edicion de productos',
            'slug'        =>'products.edit',
            'description' =>'editar cualquier dato de un producto del sistema'
        ]);

        Permission::create([
            'name'        =>'Eliminar producto',
            'slug'        =>'products.destroy',
            'description' =>'Elimina cualquier producto del sistema'
        ]);
    }

}


