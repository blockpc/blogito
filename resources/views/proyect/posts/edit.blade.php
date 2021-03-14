@extends('layouts.app')

@section('title', __('Edit Article'))
@section('actions')
<a href="{{ route('blog.show', $post) }}" target="_blank" class="btn-sm btn-primary-border w-full sm:w-auto"><i class="fas fa-eye"></i> Vista Previa</a>
@endsection

@section('content')
<div class="" x-data="{modal:false, mobile:false}">
    {{-- <div class="inline-block w-full pb-2">
        <button type="button" class="btn-sm btn-primary-border w-full sm:w-auto" x-on:click="modal=true"><i class="fas fa-eye"></i> Vista Previa</button>
    </div> --}}
    <div x-data="{ tab: window.location.hash ? window.location.hash : '#article-information' }" class="">
        <div class="flex flex-row justify-between pb-4">
            <a class="text-sm sm:text-base p-2 m-2 rounded-md bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#article-information'" :class="{ 'bg-blue-200': tab=='#article-information' }">{{__('Article Data')}}</a>
            <a class="text-sm sm:text-base p-2 m-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#article-content'" :class="{ 'bg-blue-200': tab=='#article-content' }">{{__('Content')}}</a>
            <a class="text-sm sm:text-base p-2 m-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#article-images'" :class="{ 'bg-blue-200': tab=='#article-images' }">{{__('Images')}}</a>
        </div>
        <div class="p-2">
            {{-- article-information --}}
            <div x-show="tab == '#article-information'" x-cloak>
                @livewire('proyect.posts.general', [
                    'user' => current_user(),
                    'post' => $post
                ], key(current_user()->id))
            </div>
            {{-- article-content --}}
            <div x-show="tab == '#article-content'" x-cloak>
                @livewire('proyect.posts.content', [
                    'user' => current_user(),
                    'post' => $post
                ], key(current_user()->id))
            </div>
            {{-- article-images --}}
            <div x-show="tab == '#article-images'" x-cloak>
                @livewire('proyect.posts.images', [
                    'user' => current_user(),
                    'post' => $post
                ], key(current_user()->id))
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/agate.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush