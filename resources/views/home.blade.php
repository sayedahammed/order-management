@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('orders.index') }}" method="get" class="mb-3 text-center">
                        <div class="form-group pt-3">
                            <label class="visually-hidden" for="contact_no">Order No</label>
                            <input type="text" title="Contact number must be 11 digits" pattern="^\d{11}$" required name="contact_no" autofocus id="contact_no" class="form-control" placeholder="Enter Contact Number...">
                        </div>
                        <button class="btn btn-sm btn-primary mt-2" type="submit">Search</button>
                        <button type="reset" class="btn btn-sm btn-info mt-2">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
