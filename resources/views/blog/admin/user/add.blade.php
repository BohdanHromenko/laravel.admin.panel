@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') Add user @endslot
            @slot('parent') Home @endslot
            @slot('active') Add user @endslot
        @endcomponent
    </section>

    {{--Main content--}}
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <form action="{{route('blog.admin.users.store')}}" method="post" data-toggle="validator">
                        @csrf
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="@if(old('name')){{old('name')}}@endif" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="@if(old('password')){{old('password')}}@endif" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password confirmation</label>
                                <input type="password" class="form-control" name="password_confirmation" value="@if(old('password_confirmation')){{old('password_confirmation')}}@endif" required>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="@if(old('email')){{old('email')}}@endif" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="address">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="2" selected>User</option>
                                    <option value="3">Administrator</option>
                                    <option value="1">Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" value="">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection
