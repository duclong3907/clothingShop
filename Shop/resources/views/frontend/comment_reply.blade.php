<style>
    .card-inner {
        margin-left: 4rem;
    }
    .img-account-profile {
            height: 10rem;
            border: 1px solid #000;
            border-radius: 50%;
            height: 150px;
            width: 150px;
            background: url('themes/frontend/images/user.png');
        }
</style>
<div class="container">
    <div class="div_center">
        <h2 style="font-size:30px; padding:20px 0;">Comments</h2>
        <form action="{{url('add_comment', $product->id)}}" method="POST">
            @csrf
            <textarea name="comment" id="" cols="30" rows="10" placeholder="Comment something here" class="fillComment"
                required></textarea>
            <br>
            <input type="submit" value="Comment">
        </form>
    </div>
    <h2 class="text-center">All Comments</h2>
    <div class="card">
        <div class="card-body">
            @foreach($comment as $comment)
            <div class="row">
                <div class="col-md-2">
                    <img src="{{$comment->image}}"
                        class="img-account-profile rounded-circle mb-2"/>
                    <p class="text-secondary text-center">15 Minutes Ago</p>
                </div>
                <div class="col-md-10">
                    <p>
                        <strong>{{$comment->name}}</strong>
                        <span class="float-end"><i class="text-warning fa fa-star"></i></span>
                        <span class="float-end"><i class="text-warning fa fa-star"></i></span>
                        <span class="float-end"><i class="text-warning fa fa-star"></i></span>
                        <span class="float-end"><i class="text-warning fa fa-star"></i></span>
                    </p>
                    <div class="clearfix"></div>
                    <p>{{$comment->comment}}</p>
                    <p>
                        <a href="javascript:void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}"
                            class="float-end btn btn-outline-primary ms-2"> <i class="fa fa-reply"></i> Reply</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
