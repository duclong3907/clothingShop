@php
$title = "Product";
$index=0;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  @include('admin.css')
<style>
  .div_center{
      text-align: center;
      padding:20px 0;
    }
</style>
</head>
  <body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.siderbar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
          <div class="div_center">
          @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          {{ session()->get('message') }}
        </div>
        @endif
            <h1>Manage Product</h1>

          </div>

          <table class="table mb-0 align-middle text-nowrap table-responsive">
                <thead class="border">
                    <tr>
                        <th class="border-top-0">No</th>
                        <th class="border-top-0">Title</th>
                        <th class="border-top-0">Image</th>
                        <th class="border-top-0">Category Name</th>
                        <th class="border-top-0">Price</th>
                        <th class="border-top-0">Discount</th>
                        <th class="border-top-0">Quantity</th>
                        <th class="border-top-0">Updated At</th>
                        <th class="border-top-0" style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody class="border">
                    @foreach($product as $product)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $product->title }}</td>
                            <td><img src="{{$product->image}}" style="height:150px; width:150px; border-radius:0;"></td>
                            <td>{{ $product->category }}</td>
                            <td>{{ number_format($product->price, 0) }} VNDC</td>
                            <td>{{ number_format($product->discount_price, 0) }} VNDC</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ getTimeFormat($product->updated_at) }}</td>
                            <td>
                                <a href="{{url('view_product')}}?id={{ $product->id }}" button class="btn btn-warning" style="margin-right:10px;">Edit</a>
                                <a onclick="return confirm('Are You Sure to delete this?')" href="{{url('delete_product',$product->id)}}"
                                class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

      </div>
    </div>
  </div>
  
  @include('admin.script')
  <!-- End custom js for this page -->
  </body>

</html>