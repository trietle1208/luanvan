<div class=""><!--price-range-->
            <h2>LỌC ĐÁNH GIÁ</h2>
            @for($rating = 5; $rating >= 1; $rating--)
                <ul class="list-inline" style="padding-left: 15px" title="Average Rating">
                    @for($count = 1; $count<=5; $count++)
                        @php
                            if($count<=$rating){
                                $color = 'color:#ffcc00;';
                            }else{
                                $color = 'color:#ccc;';
                            }
                        @endphp
                        <li title="đánh giá sao"
                            style="cursor:pointer; {{$color}} font-size: 15px;">
                            &#9733;
                        </li>
                    @endfor
                    @if($rating == 5 || $rating == 4)
                        @php
                        $color_text = '#0b8347';
                        @endphp
                    @elseif($rating == 3 || $rating == 2)
                        @php
                            $color_text = '#E8E055';
                        @endphp
                    @else
                        @php
                            $color_text = '#D43D3D';
                        @endphp
                    @endif
                    <li><h4 style="color : <?=$color_text ?>">{{ $rating }}.0</h4></li>
                    <li style="float: right"><button class="btn btn-sm btn-default fillterRating" data-rating="{{ $rating }}" data-url="{{ route('fillterRating') }}">Chọn</button></li>
                </ul>
            @endfor
</div><!--/price-range-->