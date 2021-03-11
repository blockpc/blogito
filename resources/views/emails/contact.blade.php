@component('mail::message')
# Correo Contacto

{{$data['firstname']}} {{$data['lastname']}}

{{$data['email']}} - {{$data['phone']}}

{{$data['message']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
