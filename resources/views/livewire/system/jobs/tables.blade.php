<div>
    <div x-data="{ tab: window.location.hash ? window.location.hash : '#jobs-queue' }" class="">
        <div class="flex flex-col sm:flex-row justify-between items-center pb-4">
            <a class="text-sm sm:text-base p-2 mx-2 rounded-md bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#jobs-queue'"
                :class="{ 'bg-blue-200': tab=='#jobs-queue' }">{{__('Jobs Queues')}}
            </a>
            <a class="text-sm sm:text-base p-2 mx-2 border-b-2 bg-gray-200 hover:bg-blue-200 w-full text-center" 
                href="#" x-on:click.prevent="tab='#jobs-failed'" 
                :class="{ 'bg-blue-200': tab=='#jobs-failed' }">{{__('Jobs Failed')}}
            </a>
        </div>
        <div class="p-0 sm:pb-2 md:pb-4">
            <div class="table-responsive" x-show="tab == '#jobs-queue'" x-cloak>
                @if ($jobs->count())
                <div wire:loading.remove class="inline-block w-full pb-2" role="group">
                    <button wire:click="start_work" type="button" class="btn-sm btn-primary mr-1 float-right">{{__('Start Work')}}</button>
                    <button wire:click="work_and_stop" type="button" class="btn-sm btn-primary mr-1 float-right">{{__('Start Work and Stop')}}</button>
                </div>
                <div class="flex justify-center pb-2">
                    <div wire:loading wire:target="start_work, work_and_stop" class="loader-blue ease-linear rounded-full border-8 border-t-8 border-gray-200 h-12 w-12"></div>
                    <div wire:loading wire:target="delete" class="loader-red ease-linear rounded-full border-8 border-t-8 border-red-200 h-12 w-12"></div>
                </div>
                @endif
                <table class="table table-sm table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Queue</th>
                            <th>Payload</th>
                            <th>Attempts</th>
                            <th>Created</th>
                            <th class="text-right">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $item)
                            <tr class="mx-auto">
                                <td class="td">{{ $item->id }}</td>
                                <td class="td">{{ $item->queue }}</td>
                                <td class="td">{{ json_decode($item->payload)->displayName }}</td>
                                <td class="td">{{ $item->attempts }}</td>
                                <td class="td">{{ \Carbon\Carbon::createFromTimestamp($item->created_at)->toDateTimeString() }}</td>
                                <td class="td text-right">
                                    <button wire:click="delete_job({{$item}})" type="button" class="btn-xs btn-danger">
                                        <i class="fas fa-times" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="td text-center" colspan="6">Sin tareas pendientas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" x-show="tab == '#jobs-failed'" x-cloak>
                <div class="flex justify-center">
                    <div wire:loading wire:target="retry, cancel" class="loader-red ease-linear rounded-full border-8 border-t-8 border-red-200 h-12 w-12"></div>
                </div>
                <table class="table table-sm table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>UUID</th>
                            <th>Queue</th>
                            <th>Payload</th>
                            <th>Exception</th>
                            <th>Failed At</th>
                            <th class="text-right">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($failed_jobs as $item)
                            <tr class="m-auto">
                                <td class="td">{{ $item->id }}</td>
                                <td class="td">{{ $item->uuid}}</td>
                                <td class="td">{{ $item->queue}}</td>
                                <td class="td">{{ json_decode($item->payload)->displayName }}</td>
                                <td class="td">{{ $item->exception }}</td>
                                <td class="td">{{ \Carbon\Carbon::createFromTimestamp($item->failed_at)->toDateTimeString() }}</td>
                                <td class="td">
                                    <div class="flex justify-center float-right" role="group">
                                        <button wire:click="retry({{$failed_job}})" type="button" class="btn btn-xs btn-primary mr-1">
                                            <i class="fas fa-check" aria-hidden="true"></i>
                                        </button>
                                        <button wire:click="cancel({{$failed_job}})" type="button" class="btn btn-xs btn-danger mr-1">
                                            <i class="fas fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="td text-center" colspan="7">Sin tareas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .loader-blue {
        border-top-color: #3498db;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }
    .loader-red {
        border-top-color: #db3434;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;
    }
    @-webkit-keyframes spinner {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spinner {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
@endpush
