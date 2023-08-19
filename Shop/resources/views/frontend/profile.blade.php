@php
$title="Cart";
@endphp
<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    @include('frontend.css')
    <style>
        body {
            margin-top: 20px;
            background-color: #f2f6fc;
            color: #69707a;
        }

        .img-account-profile {
            height: 10rem;
            border: 2px solid #000;
            border-radius: 50%;
            height: 155px;
            width: 155px;
            background: url('themes/frontend/images/user.png');
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .btnSubmit,
        .btnUpload {
            border: none;
            padding: 15px 45px;
            width: auto;
            font-size: 16px;
            text-transform: capitalize;
            line-height: normal;
            margin: 0 auto;
            display: flex;
            background: #f7444e;
            color: #fff;
            font-weight: 600;
            transition: ease all 0.1s;
        }

        .btnSubmit:hover,
        .btnUpload:hover {
            background: #333;
        }
    </style>
</head>

<body>

    @include('sweetalert::alert')
    <div class="hero_area">
        @include('frontend.header')
        <div class="container">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <form action="{{url('edit_profile')}}" method="POST">
                                @csrf
                                <div>
                                    <img class="img-account-profile rounded-circle mb-2" id="image_img"
                                        src="{{$user->image}}" alt="">
                                </div>
                                <input type="file" id="upload_file" hidden>
                                <input type="text" name="image" id="image" class="form-control" style="margin: 20px 0;"
                                    value="{{$user->image}}">
                                <button class="btnUpload" type="button" onclick="$('#upload_file').click()">Upload new
                                    image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">

                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Full Name</label>
                                <input class="form-control" id="name" type="text" name="name" value="{{$user->name}}">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Email</label>
                                <input class="form-control" id="email" type="email" name="email"
                                    value="{{$user->email}}">
                            </div>

                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="text"
                                        value="{{$user->phone}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Address</label>
                                    <input class="form-control" id="address" type="text" name="address"
                                        value="{{$user->address}}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Password</label>
                                <input class="form-control" id="password" type="password" value="{{$user->password}}">
                            </div>

                            <button class="btnSubmit" type="submit">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- end client section -->
    <!-- footer start -->
    @include('frontend.footer')
    <!-- footer end -->
</body>
<script>
    $(function () {

        $('[name=image]').change(function () {
            $('#image_img').attr('src', $(this).val())
        })

        $('#upload_file').change(function (e) {
            uploadFile(e, 'image')
        })
    })
</script>

</html>