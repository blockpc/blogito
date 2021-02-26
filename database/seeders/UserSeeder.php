<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sudo = new User();
        $sudo->name = "sudo";
        $sudo->email = "juan.marchant@gmail.com";
        $sudo->password = 'qwerty123';
        $sudo->email_verified_at = now();
        $sudo->save();
        $sudo->profile()->create([
            'firstname' => 'Juan', 
            'lastname' => 'Carlos'
        ]);
        $sudo->assignRole('sudo');

        // Admin uno
        $adminuno = new User();
        $adminuno->name = "adminuno";
        $adminuno->email = "admin.uno@mail.com";
        $adminuno->password = '123123';
        $adminuno->email_verified_at = now();
        $adminuno->save();
        $adminuno->profile()->create([
            'firstname' => 'Maria',
            'lastname' => 'Marta'
        ]);
        $adminuno->assignRole('admin');

        // Admin dos
        $admindos = new User();
        $admindos->name = "admindos";
        $admindos->email = "admin.dos@mail.com";
        $admindos->password = '123123';
        $admindos->save();
        $admindos->profile()->create([
            'firstname' => 'Sergio',
            'lastname' => 'Andres'
        ]);
        $admindos->assignRole('admin');

        /* Create more users */
        User::factory()->count(50)->create()->each(function ($user) {
            $user->profile()->save(Profile::factory()->make());
            $user->assignRole('user');
            $user->givePermissionTo('user view');
        });
    }
}
