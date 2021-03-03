<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Role for developer */
        $role_sudo = Role::create([
            'name' => 'sudo',
            'display_name' => 'Super Administrador'
        ]);
		/* Role for your admin/client/boss */
        $role_admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador'
        ]);
		/* Role for 'user' app */
        $role_user = Role::create([
            'name' => 'user',
            'display_name' => 'Usuario'
        ]);

        /**
         * Permissions
         */
        $super_admin    = Permission::create([
            'name' => 'super admin', 
            'display_name' => 'Super usuario',
            'description' => 'Permiso del desarrollador. Necesario para evaluar el funcionamiento del sistema y correción de errores',
            'key' => 'sudo',
        ]);

        $jobs_control = Permission::create([
            'name' => 'jobs control', 
            'display_name' => 'Control Tareas',
            'description' => 'Controla las tareas pendientes y fallidas del sistema',
            'key' => 'jobs',
        ]);

        $user_list     = Permission::create([
            'name' => 'user list', 
            'display_name' => 'Listado de Usuarios',
            'description' => 'Permite acceder al listado de usuarios',
            'key' => 'users',
        ]);
        $user_view      = Permission::create([
            'name' => 'user view', 
            'display_name' => 'Ver Usuario',
            'description' => 'Permite ver el perfil de un usuario',
            'key' => 'users',
        ]);
        $user_create    = Permission::create([
            'name' => 'user create', 
            'display_name' => 'Crear Usuarios',
            'description' => 'Permite crear un nuevo usuario',
            'key' => 'users',
        ]);
        $user_update    = Permission::create([
            'name' => 'user update', 
            'display_name' => 'Actualizar Usuarios',
            'description' => 'Permite actualizar la información de un usuario',
            'key' => 'users',
        ]);
        $user_delete    = Permission::create([
            'name' => 'user delete', 
            'display_name' => 'Eliminar Usuarios',
            'description' => 'Permite eliminar un usuario',
            'key' => 'users',
        ]);
        $user_restore   = Permission::create([
            'name' => 'user restore', 
            'display_name' => 'Restaurar Usuario',
            'description' => 'Permite restaurar un usuario eliminado anteriormente',
            'key' => 'users',
        ]);

        $role_list      = Permission::create([
            'name' => 'role list', 
            'display_name' => 'Listado de Roles',
            'description' => 'Permite acceder al listado de roles',
            'key' => 'roles',
        ]);
        $role_view      = Permission::create([
            'name' => 'role view', 
            'display_name' => 'Ver Roles',
            'description' => 'Permite ver un rol',
            'key' => 'roles',
        ]);
        $role_create    = Permission::create([
            'name' => 'role create', 
            'display_name' => 'Crear Roles',
            'description' => 'Permite crear un rol',
            'key' => 'roles',
        ]);
        $role_update    = Permission::create([
            'name' => 'role update', 
            'display_name' => 'Actualizar Roles',
            'description' => 'Permite actualizar un rol',
            'key' => 'roles',
        ]);
        $role_delete    = Permission::create([
            'name' => 'role delete', 
            'display_name' => 'Eliminar Roles',
            'description' => 'Permite eliminar un rol',
            'key' => 'roles',
        ]);

        $permission_view = Permission::create([
            'name' => 'permission list', 
            'display_name' => 'Listado de Permisos',
            'description' => 'Permite el acceso a la lista de permisos',
            'key' => 'permissions',
        ]);
        $permission_control = Permission::create([
            'name' => 'permission control', 
            'display_name' => 'Control de Permisos',
            'description' => 'Permite crear, editar y eliminar permisos. Este rol esta asigando al desarrollador',
            'key' => 'permissions',
        ]);

        $article_list      = Permission::create([
            'name' => 'post list', 
            'display_name' => 'Listado de Articulos',
            'description' => 'Permite acceder al listado de articulos',
            'key' => 'articles',
        ]);
        $article_view      = Permission::create([
            'name' => 'post view', 
            'display_name' => 'Ver Articulos',
            'description' => 'Permite ver un articulo',
            'key' => 'articles',
        ]);
        $article_create    = Permission::create([
            'name' => 'post create', 
            'display_name' => 'Crear Articulos',
            'description' => 'Permite crear un articulo',
            'key' => 'articles',
        ]);
        $article_update    = Permission::create([
            'name' => 'post update', 
            'display_name' => 'Actualizar Articulos',
            'description' => 'Permite actualizar un articulo',
            'key' => 'articles',
        ]);
        $article_delete    = Permission::create([
            'name' => 'post delete', 
            'display_name' => 'Eliminar Articulos',
            'description' => 'Permite eliminar un articulo',
            'key' => 'articles',
        ]);

        /**
         * Assign permissions to role
         */
        $role_sudo->givePermissionTo($super_admin);
        $role_admin->syncPermissions([
            $jobs_control,
            $user_list, $user_view, $user_create, $user_update, $user_delete, $user_restore,
            $role_list, $role_view, $role_create, $role_update, 
            $permission_view, 
            $article_list, $article_view, $article_create, $article_update, $article_delete,
        ]);
        $role_user->syncPermissions([
            $user_view, $role_view, $permission_view, $article_view, 
        ]);
    }
}
