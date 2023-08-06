@php
$title = "User";
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

        .btnSave {
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
        }

        .form-group a {
            text-decoration: none;
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

                <div class="row">
                    <div class="col-md-10">
                        <form action="{{url('add_user')}}" method="post" id="MyForm">
                            @csrf
                            <div class="form-group">
                                <label>Full Name: </label>
                                <input type="text" name="id" hidden value="{{ ($user != null)?$user->id:'' }}">
                                <input type="text" name="name" class="form-control" required
                                    value="{{ ($user != null)?$user->name:'' }}">
                            </div>
                            <div class="form-group">
                                <label>Email: </label>
                                <input type="email" name="email" class="form-control" required
                                    value="{{ ($user != null)?$user->email:'' }}">
                            </div>
                            <div class="form-group">
                                <label>Phone Number: </label>
                                <input type="tel" name="phone" class="form-control"
                                    value="{{ ($user != null)?$user->phone:'' }}">
                            </div>
                            <div class="form-group">
                                <label>Address: </label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ ($user != null)?$user->address:'' }}">
                            </div>
                            <div class="form-group">
                                <label>Password: </label>
                                <input type="password" name="password" class="form-control" {{ ($user !=null) ? ''
                                    : 'required="true"' }} min="6">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password: </label>
                                <input type="password" name="confirm_pwd" class="form-control" {{ ($user !=null) ? ''
                                    : 'required="true"' }} min="6">
                            </div>
                            <div class="form-group">
                                <label>Role Name: </label>
                                <select class="form-control" required name="usertype" style="color:#fff;">
                                    <option value="">-- Select Role --</option>
                                    @foreach($roleList as $item)
                                    @if($user != null && $user->usertype == $item->id)
                                    <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info btnSave">Save User</button>
                                <a href="{{ url('show_user') }}">Back to list</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>