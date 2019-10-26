@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') Control Panel @endslot
            @slot('parent') Home @endslot
            @slot('active') Orders list @endslot
        @endcomponent
    </section>


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
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Sum</th>
                                    <th>Create date</th>
                                    <th>Update date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($paginator as $order)
                                    @php $class = $order->status ? 'success' : '' @endphp
                                    <tr class="{{$class}}">
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>
                                            @if ($order->status == 0) New @endif
                                            @if ($order->status == 1) Completed @endif
                                            @if ($order->status == 2) <b style="color: #cd0a0a">Deleted</b> @endif
                                        </td>
                                        <td>{{ $order->sum }} {{ $order->currency }}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->updated_at}}</td>

                                        <td>
                                            <a href="{{route('blog.admin.orders.edit', $order->id)}}" title="edit order"><i class="fa fa-fw fa-eye"></i></a>
                                            <a href="{{route('blog.admin.orders.forcedestroy', $order->id)}}" title="delete from DB"><i
                                                    class="fa fa-fw fa-close text-danger deletebd"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3"><h2>No orders</h2></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <p>{{count($paginator)}} order(s) from {{$countOrders}} </p>
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
