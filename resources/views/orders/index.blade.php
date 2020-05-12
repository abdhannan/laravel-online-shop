@extends('layouts.global')

@section('title')
    All Orders
@endsection

@section('pageTitle')
    All Orders
@endsection

@section('content')
    
    <form action="{{ route('orders.index') }}">
        <div class="row">
            <div class="col-md-5">
                <input type="text"
                name="buyer_email"
                value="{{ Request::get('buyer_email') }}"
                class="form-control"
                placeholder="Filter by buyer email">
            </div>

            <div class="col-md-2">
                <select name="status" id="status" class="form-control">
                    <option {{ Request::get('status') == "SUBMIT" ? "selected" : "" }} value="SUBMIT">SUBMIT</option>
                    <option {{ Request::get('status') == "SUBMIT" ? "selected" : "" }} value="PROCESS">PROCESS</option>
                    <option {{ Request::get('status') == "FINISH" ? "selected" : "" }} value="FINISH">FINISH</option>
                    <option {{ Request::get('status') == "CANCEL" ? "selected" : "" }} value="CANCEL">CANCEL</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="submit" value="Filter" class="btn btn-primary">
            </div>
        </div>
    </form>
    
    <hr class="my-3">

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
                <tfoot>
                    <tr>
                        <td>
                            {{--  Pagination  --}}
                            {{ $orders->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection