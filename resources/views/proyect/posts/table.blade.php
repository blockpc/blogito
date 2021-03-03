@extends('layouts.app')

@section('title', __('Articles'))

@section('content')
@livewire('proyect.posts.table', ['user' => current_user()], key(current_user()->id))
@endsection