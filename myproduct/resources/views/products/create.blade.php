@extends('products.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Add product</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top: 10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>

        </div>

    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oops! </strong>There were some problem with your input.<br><br>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    <input type="text" name="product_name" class="form-control"
                           placeholder="product Name">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Description:</strong>
                        <textarea class="form-control" style="height: 150px" name ="product_desc"
                                  placeholder="product Description"></textarea>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qty: </strong>
                        <input type="number" name="product_qty" class="form-control"
                               placeholder="Quantity">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </div>
    </form>
@endsection
