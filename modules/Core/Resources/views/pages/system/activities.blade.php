@php
    $breadcrumb = [['title' => __('core::menu.system'), 'url' => '#'], ['title' => __('core::menu.system.activities'), 'url' => '#', 'active' => true]];
@endphp

@extends('core::layouts.master')
@section('title', __('core::menu.system.activities'))
@section('content')
    <x-breadcrumb :items="$breadcrumb"></x-breadcrumb>
    <div class="row">
        <div class="col-12">
            {!! $table !!}
        </div>
    </div>
@endsection