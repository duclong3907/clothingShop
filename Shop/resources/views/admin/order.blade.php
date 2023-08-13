@php
$title = "Orders";
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
      padding-top:40px;
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
            <h1>Manage Order</h1>
            @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          {{ session()->get('message') }}
        </div>
        @endif
          </div>

          <div class="col-md-12 table-responsive">
<table class="table mb-0 align-middle text-nowrap table-bordered border">
    <thead>
        <tr>
            <th class="border-top-0">No</th>
            <th class="border-top-0">Full Name</th>
            <th class="border-top-0">Email</th>
            <th class="border-top-0">Address</th>
            <th class="border-top-0">Phone</th>
            <th class="border-top-0">Payment status</th>
            <th class="border-top-0">Delivery status</th>
            <th class="border-top-0" style="width: 100px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order as $item)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->payment_status }}</td>
            @if($item->delivery_status == 'processing')
                <td>{{ $item->delivery_status }}</td>
                <td>
                    <a href=""><button class="btn btn-primary">Delivery</button></a>
                    <a href=""><button class="btn btn-info">Details</button></a>
                    <a href="" class="btn btn-danger">Delete</a>
                </td>
            @else
                <td style="color: green;">{{ $item->delivery_status }}</td>
                <td>
                    <a href=""><button class="btn btn-info">Details</button></a>
                    <a href="" class="btn btn-danger">Delete</a>
                </td>
            @endif
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