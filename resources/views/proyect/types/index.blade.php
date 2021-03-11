@extends('layouts.app')

@section('title', __('Types Blocks'))

@section('content')
@livewire('proyect.types.table', ['user' => current_user()], key(current_user()->id))
@endsection