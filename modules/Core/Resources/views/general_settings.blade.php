@php
    $breadcrumb = [['title' => __('core::menu.settings'), 'url' => '#'], ['title' => __('core::menu.settings.general'), 'url' => '#', 'active' => true]];
@endphp
@extends('core::layouts.master')

@section('title', "General Settings")
@section('content')
    <x-breadcrumb :items="$breadcrumb">
        <div class="h4 mb-0">@lang('core::menu.settings.general')</div>
    </x-breadcrumb>
    <div class="row">
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills nav-gap-y-1">
                        <a href="#backend" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded mb-2 active">
                            <i class="fas fa-globe icon icon-sm"></i>
                            @lang('core::messages.general.backend')
                        </a>
                        <a href="#google_analytics" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded mb-2">
                            <i class="fab fa-google icon icon-sm"></i>
                            @lang('core::messages.general.google_analytics')
                        </a>
                        <a href="#maintenance" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded mb-2">
                            <i class="fas fa-plug icon icon-sm"></i>
                            @lang('core::messages.general.maintenance')
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-bottom mb-3 d-flex d-md-none">
                    <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                        <li class="nav-item">
                            <a href="#backend" data-bs-toggle="tab" class="nav-link has-icon active"><i class="fas fa-image icon icon-sm"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#google_analytics" data-bs-toggle="tab" class="nav-link has-icon"><i class="fab fa-google icon icon-sm"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#maintenance" data-bs-toggle="tab" class="nav-link has-icon"><i class="fas fa-plug icon icon-sm"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active" id="backend">
                        <h6>BACKEND</h6>
                        <hr>
                        <x-forms::base-form method="POST" :action="route('admin.settings.backend.post')" :multipart="true">
                            <x-forms::group 
                                label="App Name"
                                name="app_name" 
                                help="This name is shown in the title area of the back-end" 
                                placeholder="MyApp"
                                :required="true"
                                :value="config('app.name', 'OCMS')"
                            />
                            <x-forms::thumbnail
                                label="App Logo"
                                name="app_logo"            
                                :value="uploadPath(config('app.logo'))"                       
                            />
                            <x-forms::thumbnail
                                label="App Favicon"
                                name="app_favicon"
                                :value="uploadPath(config('app.favicon'))"                                   
                            />
                            <x-forms::group 
                                mode="select" 
                                name="app_language" 
                                label="Language" 
                                :required="true"
                            >
                                <option value="en" @if(config('app.locale', 'en') == 'en')selected @endif>English (EN)</option>
                                <option value="vi" @if(config('app.locale', 'en') == 'vi')selected @endif>Vietnamese (VI)</option>
                            </x-forms::group>
                            <x-forms::group 
                                mode="select" 
                                name="app_timezone"
                                label="Timezone" 
                                :required="true"
                            >
                                @foreach (timezones() as $timezone)
                                    <optgroup label="{{ $timezone['group'] }}">
                                        @foreach($timezone['zones'] as $zone)
                                            <option value="{{ $zone['value'] }}" @if(config('app.timezone', 'UTC') == $zone['value'])selected @endif>{{ $zone['value'] }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </x-forms::group>
                            <x-forms::group 
                                mode="switch" 
                                name="app_debug"
                                label="Debug Mode"
                                help="Only enable in development environment"
                                :checked="config('app.debug', true)"
                            />
                            <x-forms::group 
                                mode="switch" 
                                name="app_cache"
                                label="Cache Mode"
                                help="Optimize for database query and page load speed"
                                :checked="config('app.cache', false)"
                            />       
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                @lang('core::messages.save_changes')
                            </button>
                        </x-forms::base-form>        
                    </div>
                    <div class="tab-pane" id="google_analytics">
                        <h6>GOOGLE ANALYTICS</h6>
                        <hr>
                        <x-forms::base-form method="POST" :action="route('admin.settings.analytics.post')">
                            <x-forms::group 
                                label="Tracking ID"
                                name="app_analytics_trackingId" 
                                placeholder="Example: GA-123456778-9"
                                :value="config('app.analytics.trackingId', '')"
                            />
                            <x-forms::group 
                                label="View ID"
                                name="app_analytics_viewId" 
                                placeholder="Enter View ID"
                                :value="config('app.analytics.viewId', '')"
                            />
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                @lang('core::messages.save_changes')
                            </button>                            
                        </x-forms::base-form>
                    </div>
                    <div class="tab-pane" id="maintenance">
                        <h6>MAINTENANCE</h6>
                        <hr>
                        <x-forms::base-form method="POST" :action="route('admin.settings.maintenance.post')">
                            <x-forms::group 
                                mode="switch" 
                                name="app_maintenance"
                                label="Maintenance Mode"
                                help="Enable maintenance mode, visitors will see maintenance page when they try to access."
                                :checked="config('app.maintenance', true)"
                            />
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                @lang('core::messages.save_changes')
                            </button>                            
                        </x-forms::base-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
