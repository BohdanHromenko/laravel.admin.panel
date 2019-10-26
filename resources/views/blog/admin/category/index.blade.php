@extends('layouts.app_admin')

@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') Categories menu list @endslot
            @slot('parent') Home @endslot
            @slot('active') Categories menu list @endslot
        @endcomponent
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div style="width: 100%;">
                            <small style="margin-left: 70px">To edit - click on a category</small>
                            <small style="margin-left: 70px">It is not possible to delete parent categories or who have
                                products</small>
                        </div>
                        <br>
                        @if ($menu)
                            <div class="list-group list-group-root well">
                                @include('blog.admin.category.menu.customMenuItems', ['items'=>$menu->roots()])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
