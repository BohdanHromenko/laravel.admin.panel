@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        <h1>
            Edit
            Order № {{$item->id}}
            @if (!$order->status)
                <a href="{{route('blog.admin.orders.change', $item->id)}}/?status=1" class="btn btn-success btn-xs">Approve</a>
                <a href="" class="btn btn-warning btn-xs redact">Edit</a>
            @else
                <a href="{{route('blog.admin.orders.change', $item->id)}}/?status=0" class="btn btn-default btn-xs">Return for revision</a>
            @endif
            <a href="" class="btn btn-xs">
                <form method="post" action="{{route('blog.admin.orders.destroy', $item->id)}}" id="delform" style="float: none">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-xs delete">Delete</button>
                </form>
            </a>
        </h1>

        @component('blog.admin.components.breadcrumbs')
            @slot('parent') Home @endslot
            @slot('order') Orders list @endslot
            @slot('active') Order № {{$item->id}} @endslot
        @endcomponent
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{route('blog.admin.orders.save', $item->id)}}" method="post">

                                @csrf
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <td>Order number</td>
                                        <td>{{$order->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Order date</td>
                                        <td>{{$order->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Order update</td>
                                        <td>{{$order->updated_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Number of items in the order</td>
                                        <td>{{count($order_products)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Sum</td>
                                        <td>{{$order->sum}} {{$order->currency}}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer name</td>
                                        <td>{{$order->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{$order->status ? 'Completed' : 'New'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td>
                                            <input type="text" value="@if (isset($order->note)){{$order->note}} @endif" placeholder="@if (!isset($order->note))No comments @endif" name="comment">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <input type="submit" name="submit" class="btn btn-warning" value="Save">
                            </form>
                        </div>
                    </div>
                </div>

                <h3>Order details</h3>
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $qty = 0 @endphp
                                @foreach ($order_products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->qty, $qty+=$product->qty}}</td>
                                        <td>{{$product->price}}</td>
                                    </tr>
                                @endforeach

                                <tr class="active">
                                    <td colspan="2"><b>Total:</b></td>
                                    <td><b>{{$qty}}</b></td>
                                    <td><b>{{$order->sum}} {{$order->currency}}</b></td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
