@push('styles')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endpush

<div class="wrapper">
    <div class="content">
        <header class="header">
            @include('flash::message')
        </header>
    </div>
</div>




