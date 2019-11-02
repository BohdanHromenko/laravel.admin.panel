@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') Users list @endslot
            @slot('parent') Home @endslot
            @slot('active') Users list @endslot
        @endcomponent
    </section>

    {{--Main content--}}
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse ($paginator as $user)
                                    @php
                                        $class ='';
                                        $status = $user->role;
                                        if ($status == 'disabled') $class = 'danger';
                                    @endphp
                                    <tr class="{{$class}}">
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ucfirst($user->name)}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>
                                            <a href="{{route('blog.admin.users.edit', $user->id)}}" title="View user"><i class="btn btn-xs"></i><button class="btn btn-success btn-xs">View</button></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-xs">
                                                <form method="post" action="{{route('blog.admin.users.destroy', $user->id)}}" style="float: none">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-xs delete">Delete</button>
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center"><h2>No Users</h2></td>
                                    </tr>

                                @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <p>{{count($paginator)}} users from {{$countUsers}} </p>

                            @if ($paginator->total() > $paginator->count())
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                {{$paginator->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
