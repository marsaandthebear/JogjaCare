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
<x-backend.layouts.show :data="$$module_name_singular" :module_name="$module_name" :module_path="$module_path" :module_title="$module_title" :module_icon="$module_icon" :module_action="$module_action" />
@if($$module_name_singular->image)
    <div class="col-12 col-sm-6 mb-3">
        <div class="form-group">
            <strong>Gambar:</strong>
            <img src="{{ asset($$module_name_singular->image) }}" alt="{{ $$module_name_singular->name }}" class="img-fluid">
        </div>
    </div>
@endif
@endsection