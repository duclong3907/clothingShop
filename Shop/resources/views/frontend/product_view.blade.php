<section class="product_section">
         <div class="container">
            <form action="{{url('search_product')}}" style="text-align: center;">
               <input type="text" name="search" placeholder="Search for something" class="inputSearch">
            </form>
            <div class="row">
               @foreach($products as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details', $product->id)}}" class="option1">
                           {{$product->title}}
                           </a>
                           <form action="{{url('add_cart', $product->id)}}" method="POST">
                              @csrf
                              <input type="number" name="quantity" value="1" min="1" style="width:100px;" hidden>
                              <input type="submit" value="Buy Now" class="option2" style="border-radius: 30px;">
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
            <div class="pagination justify-content-center">
               {{ $products->links() }}
            </div>
         </div>
      </section>