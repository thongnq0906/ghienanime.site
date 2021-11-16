@extends('admin.partials.master')
@section('title', 'Danh sách tập phim')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Thêm mới tập phim: {{ $movies->name }}</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="hack-animehay">
                    <p>Trang animehay.site</p>
                    <form action="{{ route('hack-animehay') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="link" placeholder="Bỏ link vô đây" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="tap" min="1" max="1000" placeholder="Bao nhiêu tập thì nhập vô" required>
                            </div>
                            <div class="col-md-2">
                                <button class="btn-success btn">Xem điều kỳ diệu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        {{--<div class="upexcel">
            <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $id }}" name="product_id">
                <span>Up bằng Excel: </span><input type="file" name="file">(file .xlsx)
                <button>Xác nhận</button>
            </form>
        </div>--}}
        </div>

        <div class="main-card mb-3 card">
            @include('errors.message')
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">Vietsub</h5>
                        <form method="POST" action="{{ route('admin.product.episode.create') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $id }}" name="product_id">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tập phim: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ep" value="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Vip: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="vip" value="{{ old('vip') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Link 1: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link1" value="{{ old('link1') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Link 2: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link2" value="{{ old('link2') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Link 3: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link3" value="{{ old('link3') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Link 4: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link4" value="{{ old('link4') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Note: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="note" value="{{ old('note') }}">
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
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">Thuyết minh</h5>
                        <form method="POST" action="{{ route('admin.product.episode.create_tm') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $id }}" name="product_id">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tập phim: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ep" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Link 1: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link1" value="{{ old('link1') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Link 2: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link2" value="{{ old('link2') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Note: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="note" value="{{ old('note') }}">
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
            </div>
        </div>
        <h5 class="card-title">Danh sách tập phim</h5>
        <form action="{{ route('admin.product.check_full') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $id }}">
            <label class="checkbox-inline">
                <input type ="checkbox" name="checkbox" value="1" @if($movies->check_full == 1) checked @endif onChange="this.form.submit()">
                Full tập rồi thì đánh dấu tao
            </label>
        </form>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Vietsub</h5>
                <div class="list-ep">
                    @foreach ($list as $l)
                        <div class="sotap @if($l->id == $id) active @endif">
                            <div class="tapni">
                                <a href="{{ route('admin.product.episode.edit', [$id, $l->id]) }}">Tập {{ $l->ep }}</a>
                            </div>
                            <div class="dell-ep"><a href="{{ route('admin.product.episode.dellEp', $l->id) }}" onclick="return confirm_delete('Không hối hận ?')">x</a></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if (count($thuyetminh) != 0)
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Thuyết minh</h5>
                    <div class="list-ep">
                        @foreach ($thuyetminh as $l)
                            <div class="sotap @if($l->id == $id) active @endif">
                                <div class="tapni">
                                    <a href="{{ route('admin.product.episode.edit_tm', [$id, $l->id]) }}">Tập {{ $l->ep }}</a>
                                </div>
                                <div class="dell-ep"><a href="{{ route('admin.product.episode.dellEpTM', $l->id) }}" onclick="return confirm_delete('Không hối hận ?')">x</a></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
@endsection
