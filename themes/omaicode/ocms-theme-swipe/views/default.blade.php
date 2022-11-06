@extends('layout')

@section('content')
    <section class="section">
        <div class="{{ $template == \Modules\Page\Enums\PageTemplateEnum::BOXED ? 'container' : 'container-fluid' }}">
            {!! $content !!}
        </div>
    </section>
@endsection