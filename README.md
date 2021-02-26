# Proyecto Breeze

## Pasos previos
- laravel new my-app
- cd my-app
- composer require laravel/breeze --dev
- php artisan breeze:install

## Estilos
- npm install
- npm run dev

## Modulos de laravel
- composer require livewire/livewire
- composer require laraveles/spanish
- composer require intervention/image
- composer require yoeunes/toastr
- composer require spatie/laravel-permission

## Jobs
php artisan queue:table

## crear tablas y modelos Profiles e Image
php artisan make:model Profile -m
php artisan make:model Image -m
php artisan make:model Jobs
php artisan make:model FailedJobs

## seeders
php artisan make:seeder RoleAndPermissionsSeeder
php artisan make:seeder UserSeeder

php artisan migrete
php artisan migrate:fresh --seed
php artisan storage:link

## controladores basicos
php artisan make:controller System\SystemController
php artisan make:controller System\UserController
php artisan make:controller System\ProfileController
php artisan make:controller System\JobController

## generamos las rutas basicas
routes\system.php

## generamos componentes livewire
php artisan make:livewire system.jobs.tables
php artisan make:livewire system.permissions.table
php artisan make:livewire system.roles.table
php artisan make:livewire system.users.edit
php artisan make:livewire system.users.table