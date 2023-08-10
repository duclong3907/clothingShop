@php
$title="Detail";
@endphp
<!DOCTYPE html>
<html>

<head>
   <base href="/public">
   @include('frontend.css')
</head>

<body>
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
            <li style="color: orange; font-size: 13pt; padding-top: 2px; margin-right: 5px;">5.0</li>
            <li style="color: orange; padding: 2px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                    </path>
                </svg>
            </li>
            <li style="color: orange; padding: 2px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                    </path>
                </svg>
            </li>
            <li style="color: orange; padding: 2px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                    </path>
                </svg>
            </li>
            <li style="color: orange; padding: 2px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                    </path>
                </svg>
            </li>
            <li style="color: orange; padding: 2px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                    </path>
                </svg>
            </li>
            <li
                style="margin-left: 20px; border-left: solid #dad7d7 1px; font-size: 13pt; padding-top: 3px; padding-left: 20px;">
                79 Evaluate</li>
            <li
                style="margin-left: 20px; border-left: solid #dad7d7 1px; font-size: 13pt; padding-top: 3px; padding-left: 20px;">
                {{$product->quantity}} Sold</li>
        </ul>
                  <p style="color: red; font-size: 30px; margin-top: 15px; margin-bottom: 15px;">{{
                     number_format($product->discount_price) }} VNDC</p>
                  <p
                     style="color: grey; font-size: 15px; margin-top: 15px; margin-bottom: 15px; text-decoration: line-through;">
                     <del>{{ number_format($product->price) }} VNDC</del></p>
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
                  <button class="btn btn-success" style="margin-top: 20px; width: 100%; font-size: 30px;" type="submit"
                     onclick="addToCart()">
                     <i class="bi bi-cart4"></i> ADD TO CART
                  </button>
                  </form>
                  <button class="btn btn-secondary" onclick="return alert('The product has been added to favorites');"
                     style="margin-top: 20px; width: 100%; font-size: 30px; 
                background: #edebeb; border: none; color: #000;">
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
                           <a href="" class="option2">
                              Buy Now
                           </a>
                        </div>
                     </div>
                     <div>
                        <img src="{{ $item->image }}" alt="{{ $item->title }}" style="width: 100%; height: 200px">
                        <h5 style="height:70px;">
                           {{ $item->title }}
                        </h5>
                        <h6>
                           {{ number_format($item->discount_price, 0) }} vnd
                        </h6>
                     </div>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
      </section>

   </div>

   <!-- end client section -->
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

      xhr.onreadystatechange = function () {
         if (xhr.readyState === XMLHttpRequest.DONE) {
            // Xử lý phản hồi từ máy chủ tại đây (nếu cần)
            // window.location.reload();
         }
      };

      xhr.open("POST", "{{url('add_cart', $product->id)}}", true);
      xhr.send(formData);
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