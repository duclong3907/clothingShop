@php
$title="All Products";
@endphp
<!DOCTYPE html>
<html>
   <head>
   @include('frontend.css')
   <style>
      .div_center{
         text-align: center;
         padding: 0 0 10px;
      }
      .inputSearch{
         width: 50%;
      }
      @media (max-width: 1000px){
         .product_section .box .detail-box h5{
            font-size: 13px;
         }
         .product_section .box .detail-box h6 {
            font-size: 13px;
         }
      }
      @media (max-width: 767px){
         .inputSearch{
            width: 70%;
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
   @include('sweetalert::alert')
      <div class="hero_area">
      @include('frontend.header')

      <!-- product section -->
      @include('frontend.product_view')
      <!-- end product section -->

      <!-- footer start -->
      @include('frontend.footer')
      <!-- footer end -->
   </body>
</html>