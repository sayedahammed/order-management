@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>Customers</h4>
                <hr>
                <form action="{{ route('customers.index') }}" method="get">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <input type="text" name="contact_no" class="form-control form-control-sm" placeholder="Enter contact to search">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-sm btn-secondary">Search</button>
                            <a class="btn btn-sm btn-info" href="{{ route("customers.index") }}">Clear</a>
                        </div>
                    </div>
                </form>
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Contact No</th>
                        <th>Number of Orders</th>
                        <th>Creation Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->contact_no }}</td>
                            <td>{{ $customer->orders()->count() }}</td>
                            <td>{{ \Carbon\Carbon::make($customer->created_at)->format("d-M-Y") }}</td>
                            <td>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('orders.index', ["contact_no" => $customer->contact_no]) }}" class="btn btn-secondary btn-sm">View</a>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
