@extends('layouts.app')

@section('title', __('List Users'))

@section('actions')
<a class="btn-xs btn-info-border mr-1" href="{{ route('roles.index') }}">{{__('Roles')}}</a>
<a class="btn-xs btn-info-border mr-1" href="{{ route('permissions.index') }}">{{__('Permissions')}}</a>
@endsection

@section('content')
@livewire('system.users.table', ['user' => current_user()], key(current_user()->id))
@endsection