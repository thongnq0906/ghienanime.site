<div class="title-hd">
    <h2>BẢNG XẾP HẠNG</h2>
</div>
<div class="sidebar">
    <div class="celebrities">

        @foreach ($sidebar as $key => $s)
            <div class="celeb-item">
                <span class="Top">#{{ $key+1 }}<i></i></span>
                <a href="{{ route('detail_product', $s->slug) }}"><img src="{{ asset($s->image) }}" alt="{{ $s->name }}" width="70" height="70"></a>
                <div class="celeb-author">
                    <h6><a href="{{ route('detail_product', $s->slug) }}" title="Xem phim {{ $s->name }}">{{ $s->name }}</a></h6>
                    @php
                        $lastEp = \App\Models\Images::where('product_id', $s->id)->orderBy('ep', 'DESC')->first();
                    @endphp
                    <span>
                        @if($s->check_full == 1)
                            Full
                        @endif
                        @if($s->check_full == 3)
                            Coming soon
                        @endif
                        @if($s->check_full == null)
                            Tập @if ($lastEp) {{ $lastEp->ep }} @endif
                        @endif
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>