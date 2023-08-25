@php
$title="Detail";
@endphp
<!DOCTYPE html>
<html>
<head>
   <base href="/public">
   @include('frontend.css')
   <style>
      .evaluate{
         margin-left: 20px; 
         border-left: solid #dad7d7 1px; 
         font-size: 13pt; 
         padding-top: 3px; 
         padding-left: 20px;
      }
      .btnAdd{
         margin-top: 20px; 
         width: 100%; 
         font-size: 30px;
      }
      .card-inner {
        margin-left: 4rem;
      }

      .img-account-profile {
        height: 10rem;
        border: 1px solid #000;
        border-radius: 50%;
        height: 150px;
        width: 150px;
      }
      @media(max-width:380px) {
         .fillComment {
            height: 10px;
            width: 70vw;
         }

         .allComment {
            padding-left: 20%;
            font-size: 20px;
         }
         .evaluate{
            margin-left: 5px;
            font-size: 9pt;
            padding-left: 6px;
         }
         .bi-star-fill, .fa-star{
            height: 12px;
            width: 12px;
         }
         .btnAdd{
            font-size:20px;
         }
         .img-account-profile{
            height: 100px;
            width: 100px;
         }
         p strong{
            font-size: 15px;
         }
         .card-inner {
            margin-left: 2rem;
         }
      }
   </style>
</head>

<body>
   @include('sweetalert::alert')
   <div class="hero_area">
      @include('frontend.header')

      <section class="product_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6 text-center">
                  <img src="{{ $product->image }}" class="img-fluid" style="width:100%;">
               </div>
               <div class="col-md-6">
                  <h3>{{ $product->title }}</h3>
                  <!-- show 5 stars -->
                  <ul style="display: flex; list-style-type: none; margin: 0px; padding: 0px;">
                     <li style="color: orange; font-size: 13pt; padding-top: 2px; margin-right: 5px;" class="evaluate">5.0</li>
                     <?php for($i = 0; $i <5 ; $i++)
                     echo'<li style="color: orange; padding: 2px;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-star-fill" viewBox="0 0 16 16">
                                 <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                 </path>
                              </svg>
                           </li>'
                     ?>

                     <li class="evaluate">
                        {{$comment->count()+$reply->count()}} Evaluate
                     </li>
                     <li class="evaluate">
                        {{$product->quantity}} Sold
                     </li>
                  </ul>
                  <p style="color: red; font-size: 30px; margin-top: 15px; margin-bottom: 15px;">{{
                     number_format(($product->discount_price != null || $product->discount_price != 0) ? $product->discount_price : $product->price) }} VNDC</p>
                  <p
                     style="color: grey; font-size: 15px; margin-top: 15px; margin-bottom: 15px; text-decoration: line-through;">
                     <del>{{ number_format($product->price) }} VNDC</del>
                  </p>
                  <div class="d-flex flex-container">
                     <div>
                        <button class="btn btn-light" style="border: 1px solid #e0dede; border-radius: 0px;"
                           onclick="addMoreCart(-1)">-</button>
                     </div>
                     <div>
                        <form id="quantity-form" style="display:inline-block;">
                           @csrf
                           <input type="number" name="quantity" class="form-control" step=1 value="1" style="max-width:70px; 
            border: 1px solid #e0dede; border-radius: 0px; text-align: center;" onchange="fixCartNum()">
                        </form>
                     </div>
                     <div>
                        <button class="btn btn-light" style="border: 1px solid #e0dede; border-radius: 0px;"
                           onclick="addMoreCart(1)">+</button>
                     </div>
                  </div>
                  <button class="btn btn-success btnAdd" type="submit"
                     onclick="addToCart()">
                     <i class="bi bi-cart4"></i> ADD TO CART
                  </button>
                  </form>
                  <button class="btn btn-secondary btnAdd" onclick="return alert('The product has been added to favorites');"
                     style="background: #edebeb; border: none; color: #000;">
                     <i class="bi bi-bookmark-heart-fill"></i> ADD TO LOVE
                  </button>
               </div>
               <div class="col-md-12" style="margin-top: 50px;">
                  <h4>Product Description</h4>
                  {!! $product->description !!}
               </div>
               <div class="col-md-12">
                  <h4 style="text-align:center;">Related Products</h4>
               </div>
               @foreach($productList as $item)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details', $item->id)}}" class="option1">
                              {{ $item->title }}
                           </a>
                           <form action="{{url('add_cart', $item->id)}}" method="POST">
                              @csrf
                              <input type="number" name="quantity" value="1" min="1" style="width:100px;" hidden>
                              <input type="submit" value="Buy Now" class="option2" style="border-radius: 30px;">
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{$item->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$item->title}}
                        </h5>

                        @if($item->discount_price != null)
                        <h6 style="color:red;">
                        Discount</br>
                        {{ number_format($item->discount_price, 0) }}
                        </h6>
                        
                        <h6 style="text-decoration:line-through;">
                        Price</br>
                        {{ number_format($item->price, 0) }}
                        </h6>
                        @else

                        <h6>
                        Price</br>
                        {{ number_format($item->price, 0) }}
                        </h6>

                        @endif
                     </div>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
      </section>

   </div>

   <!-- end client section -->
   <!-- comment section -->
   @include('frontend.comment_reply')
   <!-- end comment section -->
   <!-- footer start -->
   @include('frontend.footer')
   <!-- footer end -->
</body>

<script type="text/javascript">
   function addToCart() {
      Swal.fire({
         icon: 'success',
         title: 'Product addded successfully!'
      });
      var formData = new FormData(document.getElementById("quantity-form"));
      var xhr = new XMLHttpRequest();

      xhr.open("POST", "{{url('add_cart', $product->id)}}", true);
      xhr.send(formData);
      xhr.onreadystatechange = function () {
         if (xhr.readyState === XMLHttpRequest.DONE) {
            // Xử lý phản hồi từ máy chủ tại đây (nếu cần)
            window.location.reload();
         }
      };

   }

   function addMoreCart(delta) {
      num = parseInt($('[name=quantity]').val())
      num += delta;
      if (num < 1) num = 1
      $('[name=quantity]').val(num);
   }

   function fixCartNum() {
      $('[name=quantity]').val(Math.abs($('[name=quantity]').val()));
   }
</script>

</html>