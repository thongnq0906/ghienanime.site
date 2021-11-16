@extends('admin.partials.master')
@section('title', 'Sửa')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Sửa</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.slide.postUpdate', $slide->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Tên: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Nhập tên" name="name" value="{{ $slide->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Miêu tả: </label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="Miêu tả"
                            name="description" id="editor1">
                                {{ $slide->description }}
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Link chi tiết: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Nhập tên" name="link" value="{{ $slide->link }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Vị trí: </label>
                        <div class="col-md-10">
                            <input type="number" class="form-control"
                            placeholder="Nhập vị trí" name="position"
                            value="{{ $slide->position }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Ảnh bìa: </label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <img src="{{ asset($slide->image) }}"
                            style="height: 50px; width: 50px">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Trạng thái: </label>
                        <label class="switch">
                            <input type="checkbox" name="status"
                            {{ ($slide->status) ? 'checked': '' }}>
                            <span class="slider round"></span>
                            <input type="hidden" name="id" value="1">
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Xuất hiện: </label>
                        <div class="col-md-10">
                            <select class="form-control" name="dislay">
                                <option <?php if($slide->dislay ==1) echo 'selected="selected"';?> value="1">
                                    Slide
                                </option>
                                <option <?php if($slide->dislay ==2) echo 'selected="selected"';?> value="2">
                                    Logo
                                </option>
                                <option <?php if($slide->dislay ==3) echo 'selected="selected"';?> value="3">
                                    Banner
                                </option>
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