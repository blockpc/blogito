@extends('layouts.app')

@section('title', __('Permissions'))

@section('actions')
<a class="btn-xs btn-info-border mr-1" href="{{ route('users.index') }}">{{__('List Users')}}</a>
<a class="btn-xs btn-info-border mr-1" href="{{ route('roles.index') }}">{{__('Roles')}}</a>
@endsection

@section('content')
@livewire('system.permissions.table', ['user' => current_user()], key(current_user()->id))
@endsection