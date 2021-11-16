@extends('admin.partials.master')
@section('title', 'Thêm sản phẩm mới')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Thêm sản phẩm mới</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.product.createPost') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tên sản phẩm: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Danh mục: </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="cate_product_id">
                                <?php  menu($data);?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ảnh bìa: </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ảnh chi tiết: </label>
                        <div class="col-sm-10">
                            <a class="btn btn-primary btn-sm addimg" style="margin: 0">+ Thêm ảnh</a>
                        </div>
                    </div>
                    <div class="form-group" id="contentimg">
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Trạng thái: </label>
                        <div class="col-sm-10">
                            <label class="switch">
                                <input type="checkbox" name="status" value="0">
                                <span class="slider round"></span>
                                <input type="hidden" name="id" value="1">
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sản phẩm trang chủ: </label>
                        <div class="col-sm-10">
                            <label class="switch">
                                <input type="checkbox" name="is_home" value="0">
                                <span class="slider round"></span>
                                <input type="hidden" name="idd" value="1">
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giá: </label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Vị trí: </label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="position" value="{{ old('position') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giới thiệu: </label>
                        <div class="col-sm-10">
                            <textarea name="title" class="form-control " id="editor2" value="{{ old('title') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Miêu tả: </label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control " id="editor1" value="{{ old('description') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title_SEO: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title_seo" value="{{ old('title_seo') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Meta_key: </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="meta_key" value="{{ old('meta_key') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Meta_Des: </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="meta_des" value="{{ old('meta_des') }}"></textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn"
                                href="{{ route('admin.product.create') }}">
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
    CKEDITOR.replace( 'editor2', {
        filebrowserBrowseUrl: '{{ route('ckfinder-customer') }}',
    } );

    $(document).ready(function() {
        $('.addimg').on('click', function(){
            $('#contentimg').append('<div class="form-group row"><label class="col-sm-2 col-form-label"></label><div class="col-sm-8"><input type="file" class="form-control-file" name="img[]"></div></div>');
        });
    });
</script>
@endsection
