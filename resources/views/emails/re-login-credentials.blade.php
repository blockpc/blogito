@component('mail::message')
# Nueva clave generada

Saludos {{ $user->name }}, usa estas credenciales para ingresar al sistema.

@component('mail::table')
|  Email  | Contraseña | Role |
|:--------|:-----------|:-----|
{{ $user->email }} | {{ $password }} | {{ $user->roles->pluck('display_name')->join(', ') }}
@endcomponent

@component('mail::button', ['url' => url('login')])
Ir al Login
@endcomponent

*La contraseña fue generada aleatoriamente y la puedes cambiar desde tu perfil.*

Gracias<br>
{{ config('app.name') }}
@endcomponent
