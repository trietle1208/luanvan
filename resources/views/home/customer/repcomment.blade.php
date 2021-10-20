<ul>
    <li><img src="{{ $comment->admin->info->tt_hinhanh ?? $comment->customer->kh_hinhanh ?? asset('assets/images/avt_null.jpg') }}" style="width: 50px; height: 50px" class="img-fluid avatar"></li>
    <li><a href=""></i>{{ $comment->admin->name ?? $comment->customer->kh_hovaten }}</a></li>
{{--    <li><a href=""><i class="fa fa-clock-o"></i>{{ $dt->diffForHumans($now) }}</a></li>--}}
    <li><a href=""><i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</a></li>
    <li><a href=""><i class="fa fa-calendar-o"></i>{{ $dt->toDateString() }}</a></li>
</ul>
<p>{{ $comment->bl_noidung }}</p>
