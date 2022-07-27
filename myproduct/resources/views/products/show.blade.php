@extends('products.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Show product</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top: 10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>

        </div>

    </div>
    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    {{ $product->product_name }}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Description:</strong>
                        {{ $product->product_desc }}
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qty: </strong>
                        {{ $product->product_qty }}
                    </div>
                </div>


            </div>
        </div>
    </form>
@endsection
