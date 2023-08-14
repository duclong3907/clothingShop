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

      .fillComment{
         height:150px;
         width:50vw;
      }
      .allComment{
         padding-left:20%;
         font-size:20px;
      }
   </style>
   </head>
   <body>
   @include('sweetalert::alert')
      <div class="hero_area">
      @include('frontend.header')
         <!-- slider section -->
      
      
      <!-- product section -->
      @include('frontend.product_view')
      <!-- end product section -->


     
      <!-- footer start -->
      @include('frontend.footer')
      <!-- footer end -->
   </body>
</html>