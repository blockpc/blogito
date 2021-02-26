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
        ]);

        $jobs_control = Permission::create([
            'name' => 'jobs control', 
            'display_name' => 'Control Tareas',
            'description' => 'Controla las tareas pendientes y fallidas del sistema',
        ]);

        $user_list     = Permission::create([
            'name' => 'user list', 
            'display_name' => 'Listado de Usuarios',
            'description' => 'Permite acceder al listado de usuarios',
        ]);
        $user_view      = Permission::create([
            'name' => 'user view', 
            'display_name' => 'Ver Usuario',
            'description' => 'Permite ver el perfil de un usuario',
        ]);
        $user_create    = Permission::create([
            'name' => 'user create', 
            'display_name' => 'Crear Usuarios',
            'description' => 'Permite crear un nuevo usuario',
        ]);
        $user_update    = Permission::create([
            'name' => 'user update', 
            'display_name' => 'Actualizar Usuarios',
            'description' => 'Permite actualizar la información de un usuario',
        ]);
        $user_delete    = Permission::create([
            'name' => 'user delete', 
            'display_name' => 'Eliminar Usuarios',
            'description' => 'Permite eliminar un usuario',
        ]);
        $user_restore   = Permission::create([
            'name' => 'user restore', 
            'display_name' => 'Restaurar Usuario',
            'description' => 'Permite restaurar un usuario eliminado anteriormente',
        ]);

        $role_list      = Permission::create([
            'name' => 'role list', 
            'display_name' => 'Listado de Roles',
            'description' => 'Permite acceder al listado de roles',
        ]);
        $role_view      = Permission::create([
            'name' => 'role view', 
            'display_name' => 'Ver Roles',
            'description' => 'Permite ver un rol',
        ]);
        $role_create    = Permission::create([
            'name' => 'role create', 
            'display_name' => 'Crear Roles',
            'description' => 'Permite crear un rol',
        ]);
        $role_update    = Permission::create([
            'name' => 'role update', 
            'display_name' => 'Actualizar Roles',
            'description' => 'Permite actualizar un rol',
        ]);
        $role_delete    = Permission::create([
            'name' => 'role delete', 
            'display_name' => 'Eliminar Roles',
            'description' => 'Permite eliminar un rol',
        ]);

        $permission_view = Permission::create([
            'name' => 'permission list', 
            'display_name' => 'Listado de Permisos',
            'description' => 'Permite el acceso a la lista de permisos',
        ]);
        $permission_control = Permission::create([
            'name' => 'permission control', 
            'display_name' => 'Control de Permisos',
            'description' => 'Permite crear, editar y eliminar permisos. Este rol esta asigando al desarrollador',
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
        ]);
        $role_user->syncPermissions([
            $user_view
        ]);
    }
}
