@extends('layouts.app')

@section('title', __('Jobs List'))

@section('content')
@livewire('system.jobs.tables', ['user' => current_user()], key(current_user()->id))
@endsection