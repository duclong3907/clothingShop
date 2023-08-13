@php
$title = "OrderDetail";
$index=0;
$search="";
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
                    <h1>Order Detail</h1>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <table class="table table-bordered">
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $orderId->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $orderId->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $orderId->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $orderId->address }}</td>
                            </tr>
                        </table>
                        <p>
                            <a href="{{ url('order') }}">Back to list</a>
                        </p>
                    </div>
                    <div class="col-md-7">
                        <table class="table mb-0 align-middle text-nowrap table-responsive">
                            <thead class="border">
                                <tr>
                                    <th class="border-top-0">No</th>
                                    <th class="border-top-0">Title</th>
                                    <th class="border-top-0">Thumbnail</th>
                                    <th class="border-top-0">Price</th>
                                    <th class="border-top-0">Number</th>
                                    <th class="border-top-0">Total Price</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                @php
                                $total_money=0;
                                @endphp
                                @foreach($itemList as $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><img src="{{ $item->image }}" style="height: 150px; width:150px; border:none;">
                                    </td>
                                    <td>{{ number_format($item->price, 0) }}</td>
                                    <td>{{ number_format($item->num) }}</td>
                                    <td>{{ number_format($item->total_money) }} VND</td>
                                </tr>
                                <?php $total_money +=$item->total_money;?>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total Money</b></td>
                                    <td><b>{{number_format($total_money,0)}} VND</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>


        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>