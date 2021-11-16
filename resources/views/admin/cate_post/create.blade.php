@extends('admin.partials.master')
@section('title', 'Thêm danh mục')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Thêm danh mục</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST"action="{{ route('admin.cate_post.createPost') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Tên danh mục: </label>
                            <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                    placeholder="Name" name="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Vị trí: </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control"
                                placeholder="Vị trí" name="position" value="{{ old('position') }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Ảnh bìa: </label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Trạng thái: </label>
                            <div class="col-sm-10">
                                <label class="switch">
                                    <input type="checkbox" name="status" value="0">
                                    <span class="slider round"></span>
                                    <input type="hidden" name="id" value="1">
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Danh mục: </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="parent_id">
                                    <option value="0" selected="selected">Chọn danh mục</option>
                                    <?php  menu($data);?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-sm-2 control-label">Miêu tả: </label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control " id="editor1">{{ old('description') }}</textarea>
                                </div>
                            </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Title_SEO: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Title SEO"
                                name="title_seo" value="{{ old('title_seo') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Meta_key: </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Meta_key"
                                name="meta_key">{{ old('meta_key') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Meta_Des: </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Meta_Des"
                                name="meta_des">{{ old('meta_des') }}</textarea>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn"
                                href="{{ route('admin.cate_post.create') }}">
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