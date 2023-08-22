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
    <div class="card" style="border:none">
        @foreach($comment as $comment)
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{($comment->image != '') ? $comment->image : 'themes/frontend/images/user.png'}}" class="img-account-profile rounded-circle mb-2" />
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
            @foreach($reply as $rep)
            @if($rep->comment_id == $comment->id)
            <div class="card card-inner" style="border: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{($rep->image != '') ? $rep->image : 'themes/frontend/images/user.png'}}"
                                class="img-account-profile rounded-circle mb-2" />
                            <p class="text-secondary text-center">15 Minutes Ago</p>
                        </div>
                        <div class="col-md-10">
                            <p><strong>{{$rep->name}}</strong></p>
                            <p>{{$rep->reply}}</p>
                            <p>
                                <a href="javascript:void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}"
                                    class="float-end btn btn-outline-primary ms-2"> <i class="fa fa-reply"></i>
                                    Reply</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endforeach
    </div>
    <div style="display: none;" class="replyDiv row justify-content-center mt-4">
        <div class="col-md-8">
            <form action="{{url('add_reply')}}" method="POST">
                @csrf
                <input type="text" id="commentId" name="commentId" hidden="">
                <textarea name="reply" rows="3" placeholder="Write something here" class="form-control mb-3"
                    required></textarea>
                <button type="submit" class="btn btn-warning">Reply</button>
                <a href="javascript:void(0);" onclick="replyClose(this)" class="btn btn-secondary">Close</a>
            </form>
        </div>
    </div>
</div>

<script>
    function reply(caller) {
        document.getElementById('commentId').value = $(caller).attr('data-Commentid');
        $('.replyDiv').insertAfter($(caller));

        $('.replyDiv').show();
    }
    function replyClose(call) {
        $('.replyDiv').hide();
    }

</script>