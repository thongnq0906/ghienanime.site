@extends('admin.partials.master')
@section('title', 'Sửa danh mục')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Sửa danh mục</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST"action="{{ route('admin.cate_post.postUpdate', $cate_post->slug) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Tên danh mục: </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name"
                                name="name" value="{{ $cate_post->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Danh mục</label>
                            <div class="col-md-10">
                                <select class="form-control" name="parent_id">
                                    <option value="{{ $cate_post->parent_id }}">
                                        {{ $cate_post->name }}
                                    </option>
                                    <option value="0">
                                        Danh mục cha
                                    </option>
                                    <?php  menu($data);?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Ảnh bìa: </label>
                            <div class="col-md-10">
                                <input type="file" class="form-control-file" name="image"
                                value="{{ $cate_post->image }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-10">
                                <img src="{{asset($cate_post->image)}}" style="max-width: 30%;"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Vị trí: </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Vị trí"
                                name="position" value="{{ $cate_post->position }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Miêu tả: </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Miêu tả"
                                name="description" value="{{ $cate_post->description }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Trạng thái: </label>
                            <div class="col-md-10">
                                <label class="switch">
                                    <input type="checkbox" name="status"
                                    value="0" {{($cate_post->status)?'checked':''}}>
                                    <span class="slider round"></span>
                                    <input type="hidden" name="id" value="1">
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Title_SEO: </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Title SEO"
                                name="title_seo" value="{{ $cate_post->title_seo }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Meta_key: </label>
                            <div class="col-md-10">
                                <textarea type="text" class="form-control" placeholder="Meta_key"
                                name="meta_key">{{ $cate_post->meta_key }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Meta_des: </label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Meta_Des"
                                name="meta_des">{{ $cate_post->meta_des }}</textarea>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn" href="{{ route('admin.cate_post.home') }}">
                                    Hủy
                                </a>
                                <a class="btn-default btn" href='javascript:goback()'>Quay lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection