@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') User edit @endslot
            @slot('parent') Home @endslot
            @slot('user') Users list @endslot
            @slot('active') User edit @endslot
        @endcomponent
    </section>

    {{--Main content--}}
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    {{--for validation data-toggle="validator"--}}
                    <form action="{{route('blog.admin.users.update', $item->id)}}" method="post" data-toggle="validator">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="login">Login <small style="font-size: small; font-weight: normal">changes automatic</small></label>
                                <input type="text" class="form-control" placeholder="{{ucfirst($item->name)}}" disabled>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password if you want to change it">
                            </div>
                            <div class="form-group">
                                <label for="">Confirm password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="@if (old('name')){{old('name')}}@else{{$item->name ?? ""}}@endif" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="@if (old('email')){{old('email')}}@else{{$item->email ?? ""}}@endif" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="address">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="2" @php if ($role == 'user') echo ' selected' @endphp>User</option>
                                    <option value="3" @php if ($role == 'admin') echo ' selected' @endphp>Administrator</option>
                                    <option value="1" @php if ($role == 'disabled') echo ' selected' @endphp>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <h3>User orders</h3>
                <div class="box">
                    <div class="box-body">
                        @if ($count)

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Sum</th>
                                        <th>Create date</th>
                                        <th>Update date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($orders as $order)
                                        @php $class = $order->status ? 'success' : '' @endphp
                                        <tr class="{{$class}}">
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->status ? 'Completed' : 'New'}}</td>
                                            <td>{{$order->sum}} {{$order->currency}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->updated_at}}</td>
                                            <td><a href="{{route('blog.admin.orders.edit', $order->id)}}"><i class="fa fa-fw fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @else
                            <p class="text-danger">User hasn’t ordered anything yet...</p>
                        @endif

                    </div>
                </div>

                <div class="text-center">
                    <p>{{count($count_orders)}} orders out of {{$count}}</p>

                    @if ($orders->total() > $orders->count())
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        {{$orders->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

@endsection
