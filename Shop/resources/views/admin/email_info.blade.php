@php
$title = "FeedBack";
$index=0;
$search='';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <base href="/public">
  @include('admin.css')
  <style>
    .div_center {
      text-align: center;
    }

    .btnSend {
      display: block;
      margin: auto;
      width: 20%;
      margin-top: 50px;
      padding: 10px 0;
      background: #6fd649;
      color: #fff;
      border: 0;
      outline: none;
      font-size: 18px;
      border-radius: 4px;
      cursor: pointer;
      box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
      margin: auto;
      height: 40px;
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
        </div>
        <div class="row">
          <div class="col-md-8 mx-auto">
            <form action="{{url('send_user_email',$contact->id)}}" method="POST">
              @csrf
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title" style="text-transform:none; text-align:center">Send Email to {{$contact -> email}}</h3>
                  <div class="form-group">
                    <label for="greeting">Email Greeting:</label>
                    <input type="text" id="greeting" name="greeting" class="form-control">
                  </div>
        
                  <div class="form-group">
                    <label for="firstline">Email First Line:</label>
                    <input type="text" id="firstline" name="firstline" class="form-control">
                  </div>
        
                  <div class="form-group">
                    <label for="body">Email Body:</label>
                    <textarea id="body" name="body" class="form-control" rows="4"></textarea>
                  </div>
        
                  <div class="form-group">
                    <label for="button">Email Button Name:</label>
                    <input type="text" id="button" name="button" class="form-control">
                  </div>
        
                  <div class="form-group">
                    <label for="url">Email URL:</label>
                    <input type="text" id="url" name="url" class="form-control">
                  </div>
        
                  <div class="form-group">
                    <label for="lastline">Email Last Line:</label>
                    <input type="text" id="lastline" name="lastline" class="form-control">
                  </div>
        
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btnSend">Send</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        
    </div>



        @include('admin.script')

        <!-- End custom js for this page -->
</body>

</html>