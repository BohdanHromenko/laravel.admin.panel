@extends('layouts.app_admin')

@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') Control Panel @endslot
            @slot('parent') Home @endslot
            @slot('active') @endslot
        @endcomponent
    </section>
@endsection
