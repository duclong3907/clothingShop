@php
$title="Order";
$index1=$index2=$index3=$index4=$index5=0;
@endphp
<!DOCTYPE html>
<html>

<head>
    @include('frontend.css')
    <style>
        .title {
            margin-bottom: 5vh;
        }

        .card {
            max-width: 100%;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.3);
            border-radius: 1rem;
            border: transparent;
            margin-bottom: 50px;
            margin-left: auto;
            margin-right: auto;
        }

        @media(max-width:767px) {
            .card {
                margin: 3vh auto;
            }
        }

        .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }

        @media(max-width:767px) {
            .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }
        }


        .row {
            margin: 0;
        }

        .title b {
            font-size: 1.5rem;
        }

        .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }

        .col-2,
        .col {
            padding: 0 1vh;
        }


        .back-to-shop {
            margin-top: 4.5rem;
        }


        select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        a {
            color: black;
        }

        a:hover {
            color: blue;
            text-decoration: none;
        }

        .navtab {
            min-width: 5rem;
        }

        .nav-pills .navtab {
            margin: 0 2rem;
        }
        thead tr th{
            background-color:skyblue;
        }
    </style>
</head>

<body>

    <div class="hero_area">
        @include('frontend.header')

        <div class="card">
            <div class="row">
                <div class="col-md-12 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>My Cart</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">{{$cartNum}} Products</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active navtab" id="pills-all-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all"
                                    aria-selected="true">All</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link navtab" id="pills-wait-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-wait" type="button" role="tab" aria-controls="pills-wait"
                                    aria-selected="false">Wait Payment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link navtab" id="pills-process-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-process" type="button" role="tab"
                                    aria-controls="pills-process" aria-selected="false">Processing</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link navtab" id="pills-complete-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-complete" type="button" role="tab"
                                    aria-controls="pills-complete" aria-selected="false">Complete</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link navtab" id="pills-cancel-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-cancel" type="button" role="tab" aria-controls="pills-cancel"
                                    aria-selected="false">Cancel</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                            aria-labelledby="pills-all-tab" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-striped
                                table-hover	
                                table-borderless
                                table-primary
                                align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Payment Status</th>
                                            <th>Delivery</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($order as $orderAll)
                                        <tr class="table-warning">
                                            <td scope="row">{{$orderAll->title}}</td>
                                            <td><img src="{{$orderAll->image}}" alt="orders" style="width: 3.5rem;">
                                            </td>
                                            <td>{{$orderAll->num}}</td>
                                            <td>{{$orderAll->price}}</td>
                                            <td>{{$orderAll->payment_status}}</td>
                                            <td>{{$orderAll->delivery_status}}</td>
                                            <td><a href="" class="btn btn-danger">Cancel</a></td>
                                        </tr>
                                        <?php $index1++?>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($index1 == 0)
                                <p style="text-align:center;">There are no orders!</p>
                                @endif
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-wait" role="tabpanel" aria-labelledby="pills-wait-tab"
                            tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-striped
                                    table-hover	
                                    table-borderless
                                    table-primary
                                    align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Payment Status</th>
                                            <th>Delivery</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($order as $wait)
                                        @if($wait->payment_status == 'Cash on delivery' && $wait->delivery_status =='processing')
                                        <tr class="table-warning">
                                            <td scope="row">{{$wait->title}}</td>
                                            <td><img src="{{$wait->image}}" alt="orders" style="width: 3.5rem;"></td>
                                            <td>{{$wait->num}}</td>
                                            <td>{{$wait->price}}</td>
                                            <td>{{$wait->payment_status}}</td>
                                            <td>{{$wait->delivery_status}}</td>
                                            <td><a href="" class="btn btn-danger">Cancel</a>
                                            </td>
                                            <?php $index2++?>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($index2 == 0)
                                <p style="text-align:center;">There are no orders!</p>
                                @endif
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-process" role="tabpanel"
                            aria-labelledby="pills-process-tab" tabindex="0">

                            <div class="table-responsive">
                                <table class="table table-striped
                                        table-hover	
                                        table-borderless
                                        table-primary
                                        align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Payment Status</th>
                                            <th>Delivery</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($order as $process)
                                        @if($process->delivery_status == 'processing')
                                        <tr class="table-warning">
                                            <td scope="row">{{$process->title}}</td>
                                            <td><img src="{{$process->image}}" alt="orders" style="width: 3.5rem;"></td>
                                            <td>{{$process->num}}</td>
                                            <td>{{$process->price}}</td>
                                            <td>{{$process->payment_status}}</td>
                                            <td>{{$process->delivery_status}}</td>
                                            <td><a href="" class="btn btn-danger">Cancel</a>
                                            </td>
                                            <?php $index3++?>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($index3 == 0)
                                <p style="text-align:center;">There are no orders!</p>
                                @endif
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-complete" role="tabpanel"
                            aria-labelledby="pills-complete-tab" tabindex="0">

                            <div class="table-responsive">
                                <table class="table table-striped
                                        table-hover	
                                        table-borderless
                                        table-primary
                                        align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Payment Status</th>
                                            <th>Delivery</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($order as $complete)
                                        @if($complete->delivery_status=='Delivered')
                                        <tr class="table-warning">
                                            <td scope="row">{{$complete->title}}</td>
                                            <td><img src="{{$complete->image}}" alt="orders" style="width: 3.5rem;">
                                            </td>
                                            <td>{{$complete->num}}</td>
                                            <td>{{$complete->price}}</td>
                                            <td>{{$complete->payment_status}}</td>
                                            <td>{{$complete->delivery_status}}</td>
                                            <td style="color:blue;">Not Allowed</td>
                                            <?php $index4++?>
                                        @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($index4 == 0)
                                <p style="text-align:center;">There are no orders!</p>
                                @endif
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab"
                            tabindex="0">

                        </div>
                    </div>

                    <div class="back-to-shop"><a href="{{url('/')}}">&leftarrow; Back to shop</a></div>
                </div>
            </div>
        </div>
        <!-- </div> -->

        <!-- end client section -->
        <!-- footer start -->
        @include('frontend.footer')
        <!-- footer end -->
</body>

</html>