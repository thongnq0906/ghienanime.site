@extends('admin.partials.master')
@section('title', 'Thêm mới')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Thêm mới</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.slide.createPost') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Tên</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Miêu tả</label>
                        <div class="col-md-10">
                            <textarea name="description" class="form-control "
                            id="editor1">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Link chi tiết</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Nhập tên" name="link" value="{{ old('link') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Vị trí: </label>
                        <div class="col-md-10">
                            <input type="number" class="form-control"
                            placeholder="Nhập vị trí" name="position" value="{{ old('position') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Ảnh bìa: </label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Trạng thái: </label>
                        <label class="switch">
                            <input type="checkbox" name="status" value="0">
                            <span class="slider round"></span>
                            <input type="hidden" name="id" value="1">
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Danh mục: </label>
                        <div class="col-md-10">
                            <select class="form-control" name="dislay">
                                <option value="1">Slide</option>
                                <option value="2">Logo</option>
                                <option value="3">Banner</option>
                            </select>
                        </div>
                    </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn-success btn">Lưu</button>
                                    <a class="btn-default btn"
                                    href="{{ route('admin.slide.create') }}">
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
@section('script')
<script>
    CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '{{ route('ckfinder-customer') }}',
    } );
</script>
@endsection

