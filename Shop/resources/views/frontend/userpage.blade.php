@php
$title="Home";
@endphp
<!DOCTYPE html>
<html>

<head>
   @include("frontend.css")
   <style>
      .arrival_section .description{
         padding: 100px 45px;
      }
      .inputSearch{
         width: 50%;
      }
       @media (max-width: 1000px) {
         .heading_container h2 {
            font-size: 2.5rem;
         }
         .arrival_section p{
            font-size:1rem;
         }
         @media (max-width: 1000px){
         .product_section .box .detail-box h5{
            font-size: 13px;
         }
         .product_section .box .detail-box h6 {
            font-size: 13px;
         }
      }
      }
      @media (max-width: 767px){
         .arrival_section .description{
            padding: 40px 45px;
         }
         .inputSearch{
            width: 70%;
         }
         .arrival_section img{
            width: 100%;
            height: 100%;
         }
      }
      @media (max-width: 335px){
         .inputSearch{
            width: 100%;
         }
      }
   </style>
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