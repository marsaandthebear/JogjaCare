@extends('frontend.layouts.app')

@section('title')
    Edit {{ $$module_name_singular->name }}'s Profile
@endsection

@section('content')
    <div class="container mx-auto flex justify-center">
        @include('frontend.includes.messages')
    </div>
    <div class="container mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <div class="mb-10 sm:grid sm:grid-cols-3 sm:gap-6">
            <div class="sm:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-xl font-semibold leading-6 text-gray-800 dark:text-white  ">@lang('Edit Profile')</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        @lang('This information will be displayed publicly so be careful what you share.')
                    </p>
                    <div class="pt-4 text-center">
                        <a href='{{ route('frontend.users.profile') }}'>
                            <div
                                class="w-full rounded border-2 border-gray-900 px-6 py-2 text-sm font-semibold text-gray-800 transition duration-200 ease-in hover:bg-gray-800 hover:text-white focus:outline-none dark:text-white dark:border-gray-400">
                                @lang(' View Profile')
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:col-span-2 sm:mt-0">
            {{ html()->modelForm($user, 'PATCH', route('frontend.users.profileUpdate'))->class('form-horizontal')->acceptsFiles()->open() }}
                <div class="mb-8 rounded-lg border bg-white p-6 shadow-lg dark:border-gray-700 dark:bg-gray-900 transition-all duration-300">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <?php
                            $field_name = 'name';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = 'required';
                            ?>
                            {{ html()->label($field_lable, $field_name)->class('block-inline text-sm font-medium') }}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('mt-1 border-gray-300 w-full py-2 px-4 bg-white dark:bg-gray-100 text-gray-800 placeholder-gray-300 rounded border shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent')->attributes(["$required"]) }}
                        </div>

                        <div class="col-span-6">
                            <label class="block-inline text-sm font-medium" for="email">Email</label>
                            <input
                                class="mt-1 w-full rounded border border-gray-300 bg-gray-200 dark:bg-gray-400 px-4 py-2 text-gray-800 placeholder-gray-300 shadow-sm focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-600"
                                id="email" type="email" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="col-span-6">
                            <?php
                            $field_name = 'mobile';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = 'required';
                            ?>
                            {{ html()->label($field_lable, $field_name)->class('block-inline text-sm font-medium') }}
                            {{ html()->text($field_name)->placeholder($field_placeholder)->class('mt-1 border-gray-300 w-full py-2 px-4 bg-white dark:bg-gray-100 text-gray-800 placeholder-gray-300 rounded border shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent')->attributes(["$required"]) }}
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-semibold">
                                Photo
                            </label>
                            <span class="mt-1 inline-block h-24 w-24 overflow-hidden rounded-full bg-gray-100">
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            </span>
                        </div>

                        <div class="col-span-6">
                            <div class="sm:pt-6">
                                <input
                                    class="focus:border-primary focus:shadow-te-primary dark:focus:border-primary relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:text-neutral-700 focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100"
                                    id="avatar" name="avatar" type="file" aria-describedby="avatar">
                            </div>
                            <div class="mt-1 text-sm text-gray-400" id="view_model_avatar_help">
                                Upload an image as profile picture.
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button
                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            type="submit">
                            Save
                        </button>
                    </div>
                </div>
                {{ html()->closeModelForm() }}
            </div>
        </div>
    </div>
@endsection