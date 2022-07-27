@extends('products.layout')
@section('content')
   <div class="row">
       <div class="col-lg-12">
           <h2 class="text-center">Product Management</h2>
       </div>
       <div class="col-lg-12 text-center" style="margin-top: 10px;margin-bottom: 10px;">
           <a class="btn btn-success" href="{{ route('products.create') }}"></a>
       </div>
   </div>
   @if ($message = Session::get('success'))
      <div class="alert alert-success">
          {{ $message }}
      </div>
   @endif

   @if(sizeof($products) > 0)
      <table class="table table-bordered">
          <tr>
              <th>No</th>
              <th>Product Name</th>
              <th>Product Description</th>
              <th>Qty.</th>
              <th width="280px">More</th>
          </tr>
          @foreach ($product as $product)
              <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_desc }}</td>
                  <td>{{ $product->product_qty }}</td>
                  <td>
                      <form action="{{ route('product.destroy',$product->id) }}"
                            method="POST">
                          <a class="btn btn-info"
                             href="{{ route('products.show',$product->id) }}">Show</a>
                          <a class="btn btn-primary"
                          href="{{ route('products.edit',$product->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>

                      </form>
                  </td>
              </tr>
          @endforeach
      </table>
   @else
     <div class="alert alert-alert">Start Adding to the Database.</div>
   @endif
   {!! $products->links() !!}
@endsection
