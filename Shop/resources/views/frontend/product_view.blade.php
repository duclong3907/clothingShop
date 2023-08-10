<section class="product_section">
         <div class="container">
            <div class="row">
               @foreach($product as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details', $product->id)}}" class="option1">
                           {{$product->title}}
                           </a>
                           
                           <form action="" method="POST">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="width:100px;">
                                 </div>
                                 <div class="col-md-4">
                                    <input type="submit" value="Buy Now">
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{$product->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product->title}}
                        </h5>

                        @if($product->discount_price != null)
                        <h6 style="color:red;">
                        Discount</br>
                        {{ number_format($product->discount_price, 0) }}
                        </h6>
                        
                        <h6 style="text-decoration:line-through;">
                        Price</br>
                        {{ number_format($product->price, 0) }}
                        </h6>
                        @else

                        <h6>
                        Price</br>
                        {{ number_format($product->price, 0) }}
                        </h6>

                        @endif
                     </div>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
      </section>