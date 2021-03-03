@extends('layouts.app')

@section('title', __('Categories'))

@section('content')
@livewire('proyect.categories.table', ['user' => current_user()], key(current_user()->id))
@endsection