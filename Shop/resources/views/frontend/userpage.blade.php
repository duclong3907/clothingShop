@php
$title="Home";
@endphp
<!DOCTYPE html>
<html>

<head>
   @include("frontend.css")
</head>

<body>
   <div class="hero_area">
      @include('sweetalert::alert')

      <!-- header section strats -->
      @include('frontend.header')
      <!-- end header section -->
      <!-- slider section -->
      @include('frontend.slider')
      <!-- end slider section -->
   </div>
   <!-- why section -->
   @include('frontend.why')
   <!-- end why section -->

   <!-- arrival section -->
   @include('frontend.new_arival')
   <!-- end arrival section -->
   <!-- product section -->
   @include('frontend.product')
   <!-- end product section -->

   <!-- subscribe section -->
   @include('frontend.subscribe')
   <!-- end subscribe section -->
   <!-- client section -->
   @include('frontend.client')
   <!-- end client section -->
   <!-- footer start -->
   @include('frontend.footer')
   <!-- footer end -->
</body>

</html>