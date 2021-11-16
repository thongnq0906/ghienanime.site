
                                @php
                                    $lastEp = \App\Models\Images::where('product_id', $mvh->id)->orderBy('ep', 'DESC')->first();
                                    $checkTM = \App\Models\Narration::where('product_id', $mvh->id)->get();
                                @endphp
                                @if($mvh->check_full == 1)
                                    <div class="cate full">
                                        <span class="movie-full">Full</span>
                                    </div>
                                @endif
                                @if($mvh->check_full == 3)
                                    <div class="cate comingson">
                                        <span class="">Coming soon</span>
                                    </div>
                                @endif
                                @if($mvh->check_full == null)
                                    <div class="cate movie-update">
                                        <span class="">Tập @if($lastEp) {{ $lastEp->ep }} @endif</span>
                                    </div>
                                @endif

                                <div class="vs-tm">
                                    <span class="">VietSub @if(count($checkTM) != 0) +TM @endif</span>
                                </div>

                            <a href="{{ route('detail_product', $mvh->slug) }}" title="Xem phim {{ $mvh->name }}">
                                <div class="mv-img">
                                    <img src="{{ asset($mvh->image) }}" alt="{{ $mvh->name }}" width="285" height="437">
                                    <div class="icon_overlay"></div>
                                </div>
                            </a>
                            <div class="title-in">
                                <h6><a href="{{ route('detail_product', $mvh->slug) }}">{{ $mvh->name }}</a></h6>
                            </div>