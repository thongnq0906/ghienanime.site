@extends('admin.partials.master')
@section('title', 'Danh sách tập phim')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Sửa tập phim: {{ $movies->name }}</h5>

        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.product.episode.postEditTM', [$id, $episode->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $id }}" name="product_id">
                    <input type="hidden" value="{{ $episode->id }}" name="ep_id">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tập phim: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ep" value="{{ $episode->ep }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Link 1: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="link1" value="{{ $episode->link1 }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Link 2: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="link2" value="{{ $episode->link2 }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Note: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="note" value="{{ $episode->note }}">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ route('admin.product.episode.index', $id)}}">
            <button class="mb-2 mr-2 btn btn-primary"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>Thêm mới phim</button>
        </a>
        <h5 class="card-title">Danh sách tập phim</h5>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="list-ep">
                    @foreach ($list as $l)
                        <div class="sotap @if($l->id == $ep_id) active @endif">
                            <div class="tapni">
                                <a href="{{ route('admin.product.episode.edit_tm', [$id, $l->id]) }}">Tập {{ $l->ep }}</a>
                            </div>
                            <div class="dell-ep"><a href="{{ route('admin.product.episode.dellEpTM', $l->id) }}" onclick="return confirm_delete('Bạn có muốn xóa không ?')">x</a></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
