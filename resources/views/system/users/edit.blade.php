@extends('layouts.app')

@section('title', __('Edit User'))

@section('content')
@livewire('system.users.edit', ['user' => $user], key($user->id))
@endsection