@extends('admin.partials.master')
@section('title', 'Cấu hình')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Cấu hình</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form role="form" class="form-horizontal" method="post" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Tên công ty: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Tên công ty" name="name" value="{{ $settings->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Email: </label>
                        <div class="col-md-10">
                            <input type="email" class="form-control"
                            placeholder="Email" name="email" value="{{ $settings->email }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Địa chỉ: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Địa chỉ" name="address" value="{{ $settings->address }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Điện thoại: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Điện thoại" name="phone" value="{{ $settings->phone }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Hotline: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Hotline" name="hotline" value="{{ $settings->hotline }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">website: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="website" name="website" value="{{ $settings->website }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">FB: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                                   placeholder="" name="fb" value="{{ $settings->fb }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">YT: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                                   placeholder="" name="yt" value="{{ $settings->yt }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Logo: </label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="logo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <img src="{{asset($settings->logo)}}" style="max-width: 30%;"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Banner: </label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="banner">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <img src="{{asset($settings->banner)}}" style="max-width: 30%;"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Icon: </label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="icon">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <img src="{{asset($settings->icon)}}" style="max-width: 30%;"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Thẻ head: </label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="Meta_Des"
                            name="thead" id="thead">{{ $settings->thead }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Thẻ body: </label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="Meta_Des"
                            name="tbody" id="tbody">{{ $settings->tbody }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">File-robot: </label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="Meta_Des"
                            name="robot" id="robot">{{ $file }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Title_SEO: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Title SEO"
                            name="title_seo" value="{{ $settings->title_seo }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Meta_key: </label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" placeholder="Meta_key"
                                name="meta_key">{{ $settings->meta_key }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Meta_des: </label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="Meta_Des"
                            name="meta_des">{{ $settings->meta_des }}</textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn" href='javascript:goback()'>Quay lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection