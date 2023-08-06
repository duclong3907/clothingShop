@php
$title = "Categoies";
$index=0;
$search="";
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  @include('admin.css')

  <style>
    .div_center {
      text-align: center;
      padding-top: 40px;
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

        @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          {{ session()->get('message') }}
        </div>
        @endif
        <div class="div_center">
          <h2>Category Management</h2>
        </div>

        <div class="row">
          <div class="col-md-6">
            <form action="{{url('/add_category')}}" method="POST">
              @csrf
              <div class="form-group">
                <label>Role Name: </label>
                <input type="number" name="id" hidden value="{{ $id }}">
                <input type="text" name="category" class="form-control" placeholder="Enter name" value="{{ $name }}">
              </div>
              <div class="form-group">
                <button class="btn btn-success">Save Data</button>
              </div>
            </form>
          </div>

          <div class="col-md-6">
            <label></label>
            <table class="table mb-0 align-middle text-nowrap table-bordered">
              <thead>
                <tr>
                  <th class="border-top-0">No</th>
                  <th class="border-top-0">Category Name</th>
                  <th class="border-top-0" style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $data)
                <tr>
                  <td>{{ ++$index }}</td>
                  <td>{{$data->name}}</td>
                  <td>
                    <a href="{{url('view_category')}}?id={{ $data->id }}" class="btn btn-primary">Edit</a>
                    <a onclick="return confirm('Are You Sure to delete this?')"
                      href="{{url('delete_category',$data->id)}}" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('admin.script')
  <!-- End custom js for this page -->
</body>

</html>