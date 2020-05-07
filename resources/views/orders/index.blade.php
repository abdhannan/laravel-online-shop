@extends('layouts.global')

@section('title')
    All Orders
@endsection

@section('pageTitle')
    All Orders
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Status</th>
                        <th>Buyer</th>
                        <th>Total Quantity</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>
                                @if ($order->status == "SUBMIT")
                                    <span class="badge bg-warning text-light">{{ $order->status }}</span>
                                @elseif ( $order->status == "PROCESS" )
                                    <span class="badge bg-info text-light">{{ $order->status }}</span>
                                @elseif ( $order->status == "FINISH" )
                                    <span class="badge bg-success text-light">{{ $order->status }}</span>
                                @elseif ( $order->status == "CANCEL" )
                                    <span class="badge bg-dark text-light">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $order->name }}
                                <small>{{ $order->user->email }}</small>
                            </td>
                            <td>{{ $order->totalQuantity }} pc (s)</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>
                                <a href="{{ route('orders.edit', [$order->id]) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection