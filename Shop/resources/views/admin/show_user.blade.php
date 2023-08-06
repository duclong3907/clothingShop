@php
$title = "User";
$index=0;
$search = "searchUser";
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
        <div class="div_center">
          <h1>Manage User</h1>
          @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
          </div>
          @endif
        </div>

        <a href="{{url('view_user')}}"><button class="btn btn-success mb-3">Add new user</button></a>

        <table class="table mb-0 align-middle text-nowrap table-responsive">
          <thead class="border">
            <tr>
              <th class="border-top-0">No</th>
              <th class="border-top-0">Name</th>
              <th class="border-top-0">Email</th>
              <th class="border-top-0">Phone Number</th>
              <th class="border-top-0">Address</th>
              <th class="border-top-0">Role Name</th>
              <th class="border-top-0">Updated At</th>
              <th class="border-top-0" style="width: 100px">Action</th>
            </tr>
          </thead>
          <tbody class="border">
            @foreach($dataList as $item)
            <tr>
              <td>{{ ++$index }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->phone }}</td>
              <td>{{ $item->address }}</td>
              <td>{{ $item->role_name }}</td>
              <td>{{ getTimeFormat($item->updated_at) }}</td>
              <td>
                @if($item->role_name == 'Admin')
                <a href="{{ url('view_user') }}?id={{ $item->id }}"><button class="btn btn-warning">Edit</button></a>
                @else
                <a href="{{ url('view_user') }}?id={{ $item->id }}"><button class="btn btn-warning">Edit</button></a>
                <a onclick="return confirm('Are You Sure to delete this account?')"
                  href="{{url('delete_user',$item->id)}}" class="btn btn-danger">Delete</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>