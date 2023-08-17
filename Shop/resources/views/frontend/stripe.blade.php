@php
$title="Payment credit card";
$userId = Auth::id();
@endphp
<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    @include('frontend.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
@include('sweetalert::alert')
    <div class="hero_area">
        @include('frontend.header')

        <div class="container">

            <h1 class="mt-4" style="text-align:center;">Payment By Credit Card</h1>


            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="panel panel-default credit-card-box p-3">
                        <div class="panel-heading border p-3">
                            <h3 class="panel-title">Payment Details</h3>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                            @endif
                            <form role="form" action="{{ route('stripe.post', $totalmoney) }}" method="post"
                                class="require-validation border p-3" data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                @csrf
                                <div class='form-group required'>
                                    <label class='control-label'>Name on Card</label>
                                    <input class='form-control' size='4' type='text' placeholder='Enter Name'>
                                </div>
                                <div class='form-group required'>
                                    <label class='control-label'>Card Number</label>
                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'
                                        placeholder='AAAA AAAA AAAA AAAA'>
                                </div>
                                <div class='form-row row'>
                                    <div class='col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label>
                                        <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                                            size='4' type='text'>
                                    </div>
                                    <div class='col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label>
                                        <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                            type='text'>
                                    </div>
                                    <div class='col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label>
                                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                            type='text'>
                                    </div>
                                </div>
                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group d-none'>
                                        <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="greeting" class="form-control" hidden value="{{Auth::user()->name}}">
                                        <input type="text" name="firstline" class="form-control" hidden value="Products: {{$cartNum}}">
                                        <input type="text" name="body" class="form-control" hidden value="Total Money: {{ number_format($totalmoney)}} VND">
                                        <input type="text" name="lastline" class="form-control" hidden value="Payment status: Cash on Delivery">
                                        <input type="text" name="button" class="form-control" hidden value="Continue to buy">
                                        <input type="text" name="url" class="form-control" hidden value="http://127.0.0.1:8000/">
                                        <input type="submit" value="Pay Now ({{number_format($totalmoney)}} VNDC)"></input>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('frontend.footer')
    <!-- footer end -->

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">

        $(function () {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
</body>

</html>