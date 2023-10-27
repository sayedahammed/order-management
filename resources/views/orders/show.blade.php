@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('home') }}" class="btn btn-sm btn-secondary">Back</a>
                <div class="card mt-2">
                    <div class="card-body">
                        <h6 class="pb-2">Contact No: <b>{{ $contact_no }}</b></h6>
                        <form class="row row-cols-lg-auto g-1 mb-2 align-items-center" method="post" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="col-12">
                                <label class="visually-hidden" for="order_no">Order No</label>
                                <input type="number" class="form-control form-control-sm" required autofocus name="order_no" id="order_no" placeholder="Order No.">
                                <input type="hidden" name="contact_no" required value="{{ $contact_no }}">
                            </div>
                            <div class="col-12">
                                <label class="visually-hidden" for="date">Date</label>
                                <input type="date" class="form-control form-control-sm" required value="{{ \Carbon\Carbon::today()->format("Y-m-d") }}" name="date" id="date">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-primary">Add Order</button>
                            </div>
                        </form>

                        <table class="table table-bordered table-sm table-striped">
                            <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ \Carbon\Carbon::make($order->date)->format("d-M-Y") }}</td>
                                    <td>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No orders found!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
