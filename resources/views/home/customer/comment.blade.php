<div class="comment comment_{{ $comment->bl_id }}">
    <ul>
        <li><img src="{{ $comment->customer->kh_hinhanh ?? asset('assets/images/avt_null.jpg') }}" style="width: 50px; height: 50px" class="img-fluid avatar"></li>
        <li><a href="">{{ $comment->customer->kh_hovaten }}</a></li>
        <li><a href=""><i class="fa fa-clock-o"></i>{{ $dt->diffForHumans() }}</a></li>
        <li><a href=""><i class="fa fa-calendar-o"></i>{{ $dt->toDateString() }}</a></li>
    </ul>
    <ul class="list-inline" title="Average Rating">
        @for($count = 1; $count<=5; $count++)
                @php
                    if($count<= $comment->bl_sosao){
                        $color = 'color:#ffcc00;';
                    }else{
                        $color = 'color:#ccc;';
                    }
                @endphp
            <li title="đánh giá sao"
                style="cursor:pointer; {{$color}} font-size: 20px;">
                &#9733;
            </li>
        @endfor
    </ul>
    <p>{{ $comment->bl_noidung }}</p>
    <?php
        $id = Session::get('customer_id');
    ?>
    @if(isset($id))
    <p><button type="button" class="repComment" data-id="{{ $comment->bl_id }}">Trả lời</button></p>
    @endif
    <div class="comnent-rep comnent-rep_{{ $comment->bl_id }}">

    </div>
    <div class="form-repComment form-repComment_{{ $comment->bl_id }}" style="display : none">
        <form action="{{ route('customer.repComment') }}" method="POST">
            @csrf
            <input type="hidden" class="token_{{ $comment->bl_id }}" name="_token" value="{{ csrf_token() }}">
            <textarea rows="4" cols="50" class="textRepComment_{{ $comment->bl_id }}" placeholder="Viết bình luận cho sản phẩm"></textarea>
            <button type="button"
                    class="btn btn-default sendComment"
                    data-id="{{ $comment->bl_id }}"
                    data-url="{{ route('customer.repComment') }}"
                    data-key="{{ Session::get('admin_id') }}"
                    data-product="{{ $comment->sp_id }}"
                    data-kh="{{ Session::get('customer_id') }}"
            >
                Gữi phản hồi
            </button>
            <button type="button" class="btn btn-default closeRepcomment" data-id="{{ $comment->bl_id }}">
                Đóng
            </button>
        </form>
    </div>
</div>
