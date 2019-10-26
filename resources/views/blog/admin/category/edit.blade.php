@extends('layouts.app_admin')


@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') Category update {{$item->title}} @endslot
            @slot('parent') Home @endslot
            @slot('category') Categories list @endslot
            @slot('active') Category update {{$item->title}} @endslot
        @endcomponent
    </section>


    {{--Main content--}}
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form action="{{route('blog.admin.categories.update', $item->id)}}" method="post"
                          data-toggle="validator">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="title">Category name</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       required value="{{$item->title}}">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <select name="parent_id" id="parent_id" class="form-control" required>
                                    <option value="0">-- Self Category --</option>

                                    @include('blog.admin.category.include.edit_categories_all_list',['categories'=>$categories])

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keywords">Keywords</label>
                                <input type="text" name="keywords" class="form-control" id="keywords" value="{{$item->keywords}}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control" id="description" value="{{$item->description}}" required>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
