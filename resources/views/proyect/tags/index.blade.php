@extends('layouts.app')

@section('title', __('Tags'))

@section('content')
@livewire('proyect.tags.table', ['user' => current_user()], key(current_user()->id))
@endsection