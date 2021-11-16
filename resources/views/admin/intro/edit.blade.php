@extends('admin.partials.master')
@section('title', 'Sửa')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Sửa</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.intro.postUpdate', $intro->slug) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Tiêu đề: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Nhập tên" name="name" value="{{ $intro->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Vị trí: </label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" placeholder="Nhập vị trí"
                            name="position" value="{{ $intro->position }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Nội dung: </label>
                        <div class="col-md-10">
                             <textarea class="form-control" placeholder="Miêu tả"
                            name="description" id="editor1">
                                {{ $intro->description }}
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Trạng thái: </label>
                        <label class="switch">
                            <input type="checkbox" name="status"
                            {{ ($intro->status) ? 'checked': '' }}>
                            <span class="slider round"></span>
                            <input type="hidden" name="id" value="1">
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Title_SEO: </label>
                        <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Title SEO"
                                name="title_seo" value="{{ $intro->title_seo }}">
                            @if($errors->has('title_seo'))
                                <strong>
                                    <span class="help-block">
                                        {{ $errors->first('title_seo') }}
                                    </span>
                                </strong>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Meta_key: </label>
                        <div class="col-md-10">
                            <textarea type="text" class="form-control" placeholder="Meta_key"
                            name="meta_key">{{ $intro->meta_key }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Meta_des: </label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="Meta_Des"
                            name="meta_des">{{ $intro->meta_des }}</textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn"
                                href="{{ route('admin.intro.create') }}">
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