@extends('frontend.partials.master')
@section('title', $setting->name)
@section('title_seo', $setting->title_seo)
@section('meta_key', $setting->meta_key)
@section('meta_des', $setting->meta_des)
@section('loading')
	<div id="preloader">
		<img class="logo" src="{{ asset($setting->logo) }}" alt="" width="119" height="58">
		<div id="status">
			<span></span>
			<span></span>
		</div>
	</div>
@endsection
@section('content')
	<h1 style="display: none;">{{ $setting->title_seo }}</h1>
	<div class="slider movie-items">
		<div class="container">
			<div class="row">
				<div  class="slick-multiItemSlider">
					@foreach ($movieHot as $mvh)
						<div class="movie-item">
							@include('frontend.products.item')
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="movie-items">
		<div class="container">
			<div class="row style-item-movie">
					<div class="col-md-9">
						@foreach ($cate_product as $c)
							@php
							    $newMovie = \App\Models\Product::where('status', 1)->where('cate_product_id', $c->id)->orderBy('date_update', 'DESC')->take(16)->get();
							@endphp
							<div class="title-hd">
								<a href="{{ route('allProduct') }}"><h2>{{ $c->name }} mới cập nhật</h2></a>
								{{--<a href="{{ route('allProduct') }}" class="viewall">Xem tất cả <i class="ion-ios-arrow-right"></i></a>--}}
							</div>
							<div class="wrap-movie-custom">
								<div class="row">
									@foreach ($newMovie as $mvh)
										<div class="col-md-3 col-sm-3 col-xs-6 grid-item">
											<div class="movie-item item-custom">
												@include('frontend.products.item')
											</div>
										</div>
									@endforeach
								</div>
								<div class="title-hd">
									<a href="{{ route('productByCate', $c->slug) }}" class="viewall">Xem tất cả <i class="ion-ios-arrow-right"></i></a>
								</div>
							</div>
						@endforeach
					</div>
					<div class="col-md-3">
						@include('frontend.partials.sidebar')
					</div>
				</div>
		</div>
	</div>

	<div class="trailers">
		<div class="container">
			<div class="row ipad-width">
				<div class="col-md-12">
					<div class="title-hd">
						<h2>Phim sắp chiếu</h2>
					</div>
					<div class="videos">
						<div class="slider-for-2 video-ft">

								@foreach ($comingson as $c)
								<div class="anhnenvideo">
									<a data-fancybox href="{{ $c->link }}">
										<img class="card-img-top img-fluid" src="{{ asset($c->image) }}" />
										<img src="{{ asset('images/uploads/youtube.png') }}" alt="" class="icon-youtube">
									</a>
								</div>
								@endforeach

						</div>
						<div class="slider-nav-2 thumb-ft">
							@foreach ($comingson as $c)
								<div class="item">
									<div class="trailer-img">
										<img src="{{ asset($c->image) }}"  alt="{{ $c->name }}" width="4096" height="2737">
									</div>
									<div class="trailer-infor">
										<h4 class="desc">{{ $c->name }}</h4>
										<p>Coming soon</p>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- latest new v1 section-->
	<!--end of latest new v1 section-->
@endsection
@section('script')
@endsection


