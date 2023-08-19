@php
$title = "Product";
$index=0;
$search="searchProduct";
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  @include('admin.css')
  <style>
    .div_center{
      text-align: center;
      padding-top:40px;
    }
  </style>
</head>
  <body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.siderbar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
      @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          {{ session()->get('message') }}
        </div>
        @endif
          <div class="div_center">
            <h1>Add Product</h1>
          </div>

            <form action="{{url('add_product')}}" method="POST" enctype="multipart/form-data" id="MyForm">
              <div class="row">
                  <div class="col-md-8">
                      @csrf
                      <div class="form-group">
                          <label>Title: </label>
                          <input type="text" name="id" hidden value="{{ ($product != null)?$product->id:'' }}">
                          <input type="text" name="title" class="form-control" required value="{{ ($product != null)?$product->title:'' }}">
                      </div>
                      <div class="form-group mb-3">
                        <textarea name="description" id="description" class="form-control" rows="10">{{ ($product != null)?$product->description:'' }}</textarea>
                      </div>
                      <div class="form-group" style="margin-top: 30px">
                          <button class="btn btn-success">Save</button>
                          <a href="{{url('show_product')}}">Back to list</a>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Image: </label>
                          <button type="button" class="btn btn-warning" onclick="$('#upload_file').click()" style="margin-top: -10px;">Upload photos</button>
                          <input type="file" id="upload_file" hidden>
                          <input type="text" name="image" id="image" class="form-control" required value="{{ ($product != null)?$product->image:'' }}">
                          <img src="" style="max-height: 220px;" id="image_img">
                      </div>
                      <div class="form-group">
                          <label>Price: </label>
                          <input required type="number" name="price" class="form-control" value="{{ ($product != null)?$product->price:'' }}">
                      </div>
                      <div class="form-group">
                          <label>Discount: </label>
                          <input type="number" name="discount_price" class="form-control" value="{{ ($product != null)?$product->discount_price:'' }}">
                      </div>
                      <div class="form-group">
                          <label>Category Name: </label>
                          <select class="form-control" required name="category_id">
                              <option value="">-- Select Category --</option>
                              @foreach($category as $item)
                              @if($product != null && $product->category_id == $item->id)
                                    <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Quantity: </label>
                          <input required type="number" name="quantity" class="form-control" value="{{ ($product != null)?$product->quantity:'' }}">
                      </div>
                  </div>
              </div>
              </form>
      </div>
    </div>
  </div>


  @include('admin.script')
<script>
    $(function() {
        CKEDITOR.replace('description');

        $('[name=image]').change(function() {
            $('#image_img').attr('src', $(this).val())
        })

        $('#upload_file').change(function(e) {
            uploadFile(e, 'image')
        })
    })
</script>
  <!-- End custom js for this page -->
  </body>

</html>