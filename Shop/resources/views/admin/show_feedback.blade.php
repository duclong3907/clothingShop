@php
$title = "FeedBack";
$index=0;
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
          <h1>Manage Feedback</h1>
          @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
          </div>
          @endif
        </div>

        <table class="table mb-0 table-bordered align-middle text-nowrap table-responsive">
          <thead>
            <tr>
              <th class="border-top-0">No</th>
              <th class="border-top-0">Full Name</th>
              <th class="border-top-0">Email</th>
              <th class="border-top-0">Phone Number</th>
              <th class="border-top-0">Subject Name</th>
              <th class="border-top-0">Note</th>
              <th class="border-top-0">Updated At</th>
              <th class="border-top-0">Status</th>
              <th class="border-top-0" style="width: 100px">Action</th>
            </tr>
          </thead>
          <tbody >
            @foreach($dataList as $item)
            <tr>
              <td>{{ ++$index }}</td>
              <td>{{ $item->fullname }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->phone }}</td>
              <td>{{ $item->subject_name }}</td>
              <td>{{ $item->note }}</td>
              <td>{{ getTimeFormat($item->updated_at) }}</td>
              <td>
                @if($item->status == 0)
                <label class="label" style="color:#d99100;">Not read</label>
                @else
                <label class="label" style="color:#00d25b;">Read</label>
                @endif
              </td>
              <td>
                @if($item->status == 0)
                <a href="{{url('markRead', $item->id)}}" class="btn btn-warning"
                  onclick="return confirm('Are you sure this feedback is mark read')">Mark Read</a>
                <button class="btn btn-danger">Delete</button>
                @else
                <button class="btn btn-success">Read</button>
                <a href="" class="btn btn-info">Feedback</a>
                <a onclick="return confirm('Are You Sure to delete this feedback?')"
                  href="{{url('delete_feedback',$item->id)}}" class="btn btn-danger">Delete</a>
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