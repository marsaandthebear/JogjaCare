@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.$module_name.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __($module_action) }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="toolbar">
                <a href="{{ route("backend.$module_name.index") }}" class="btn btn-secondary mt-1 btn-sm" data-toggle="tooltip" title="{{ __(ucwords($module_name)) }} List"><i class="fas fa-list"></i> List</a>
            </x-slot>
        </x-backend.section-header>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td>
                                    {{ $module_name_singular->data['title'] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Text</th>
                                <td>
                                    {!! $module_name_singular->data['text'] ?? '' !!}
                                </td>
                            </tr>
                            @if(isset($module_name_singular->data['url_backend']) && $module_name_singular->data['url_backend'] != '')
                            <tr>
                                <th>URL Backend</th>
                                <td>
                                    Backend: <a href="{{$module_name_singular->data['url_backend']}}">{{$module_name_singular->data['url_backend']}}</a>
                                </td>
                            </tr>
                            @endif
                            @if(isset($module_name_singular->data['url_frontend']) && $module_name_singular->data['url_frontend'] != '')
                            <tr>
                                <th>URL Frontend</th>
                                <td>
                                    Frontend: <a href="{{$module_name_singular->data['url_frontend']}}">{{$module_name_singular->data['url_frontend']}}</a>
                                </td>
                            </tr>
                            @endif
                            @if(isset($module_name_singular->data['module']))
                            <tr>
                                <th>Module</th>
                                <td>
                                    {{ $module_name_singular->data['module'] ?? '' }}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($module_name_singular->read_at)
                                        <span class="badge bg-success">Read at: {{ $module_name_singular->read_at->diffForHumans() }}</span>
                                    @else
                                        <span class="badge bg-warning">Unread</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-end text-muted">
                    Updated: {{$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>

@endsection