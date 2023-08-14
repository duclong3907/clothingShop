@php
$title="Cart";
$index=0;
$totalmoney=0;
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

        .summary {
            background-color: #ddd;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }

        @media(max-width:767px) {
            .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }

        .summary .col-2 {
            padding: 0;
        }

        .summary .col-10 {
            padding: 0;
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

        h5 {
            margin-top: 4vh;
        }

        hr {
            margin-top: 1.25rem;
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

        input:focus::-webkit-input-placeholder {
            color: transparent;
        }

        .btnSubmit {
            background-color: #000;
            color: #fff;
        }

        .btnSubmit:hover {
            background-color: #f7444e;
            border: 1px solid #f7444e;
        }

        .btnCss {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }

        .btnCss:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none;
        }

        .btnCss:hover {
            color: white;
        }

        a {
            color: black;
        }

        a:hover {
            color: blue;
            text-decoration: none;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Firefox */
        }
    </style>
</head>

<body>

    <div class="hero_area">
        @include('frontend.header')

        <!-- <div class="container"> -->
        <div class="card">
            <div class="row">
                <div class="col-md-9 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>My Cart</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">{{$cartNum}} Products</div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background:skyblue;">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            @if ($cartNum>0)
                            <tbody>
                                @foreach($cart as $cart)
                                <div id="cart-id" data-cart-id="{{ isset($cart) ? $cart->id : '' }}" hidden></div>
                                <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{$cart->product_title}}</td>
                                    <td>
                                        <img src="{{ $cart->image }}" style="width: 3.5rem;">
                                    </td>
                                    <td>{{number_format($cart->price)}}</td>
                                    <td>
                                        <form id="quantity-form" style="display:inline-block;" method="POST"
                                            action="{{ url('update_cart',$cart->id)}}">
                                            @csrf
                                            <input type="number" name="quantity" class="form-control" step=1
                                                value="{{$cart->quantity}}" style="max-width:70px; 
                        border: 1px solid #e0dede; border-radius: 0px; text-align: center;" onclick="UpdateCart()"
                                                inputmode="numeric">
                                            <input type="submit" hidden class="changeQuantity">
                                        </form>
                                    </td>
                                    <td>{{number_format($cart->total_price)}}</td>
                                    <td>
                                        <a href="{{url('delete_cart',$cart->id)}}" onclick="confirmation(event)"
                                            class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php $totalmoney = $totalmoney + $cart->total_price ?>

                                @endforeach
                            </tbody>
                            @endif
                        </table>
                        @if($cartNum==0)
                        <p style="text-align:center;">There are no products in the cart, please return to the home to
                            purchase products!!!</p>
                        @endif
                    </div>
                    <div class="back-to-shop"><a href="{{url('/')}}">&leftarrow; Back to shop</a></div>
                </div>
                <div class="col-md-3 summary">
                    <div>
                        <h5><b>Summary</b></h5>
                    </div>
                    <hr>
                    <form action="" method="POST" id="checkoutForm">
                        @csrf
                        <div class="row">
                            <input type="text" value="{{$user->name}}" name="name" id="name">
                            <input type="text" value="{{$user->phone}}" name="phone" id="phone">
                            <input type="text" value="{{$user->address}}" name="address" id="address">
                        </div>
                        <div class="row">
                            <p>Payment methods:</p>
                            <select id="paymentMethod">
                                <option class="text-muted">Cash On Delivery</option>
                                <option class="text-muted">Pay Using Card</option>
                            </select>
                        </div>
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col" style="font-weight:800;">TOTAL PRICE</div>
                            <div>{{ number_format($totalmoney)}} VNDC</div>
                        </div>
                        <input type="submit" value="CHECKOUT" class="btnSubmit"></input>
                    </form>
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
<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        Swal.fire({
            title: "Are you sure to remove this product?",
            text: "You will not be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = urlToRedirect;
            }
        });

    }

    document.addEventListener("DOMContentLoaded", function () {
        var checkoutButton = document.querySelector(".btnSubmit");
        var paymentSelect = document.getElementById("paymentMethod");
        var checkoutForm = document.getElementById("checkoutForm");

        checkoutButton.addEventListener("click", function (event) {
            event.preventDefault();

            var selectedPaymentMethod = paymentSelect.value;

            if (selectedPaymentMethod === "Cash On Delivery") {
                checkoutForm.action = "{{url('cash_order')}}";
                checkoutForm.submit();
            } else if (selectedPaymentMethod === "Pay Using Card") {
                window.location.href = "{{url('stripe',$totalmoney)}}";
            }
        });
    });


</script>