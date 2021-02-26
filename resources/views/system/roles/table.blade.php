@extends('layouts.app')

@section('title', __('Roles'))

@section('actions')
<a class="btn-xs btn-info-border mr-1" href="{{ route('users.index') }}">{{__('List Users')}}</a>
<a class="btn-xs btn-info-border mr-1" href="{{ route('permissions.index') }}">{{__('Permissions')}}</a>
@endsection

@section('content')
@livewire('system.roles.table', ['user' => current_user()], key(current_user()->id))
@endsection