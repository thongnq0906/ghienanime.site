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
                        <label class="col-sm-2 col-form-label">Check full</label>
                        <div class="col-sm-10">
                            <input class="form-check-input" value="1" type="checkbox" name="checkfull2">
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
                        <label class="col-sm-2 control-label">Ngày ra phim: </label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Mon" id="thu" name="day_update[]">
                                <label class="form-check-label" for="thu">Thứ 2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Tue" id="thu3" name="day_update[]">
                                <label class="form-check-label" for="thu3">Thứ 3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Wed" id="thu4" name="day_update[]">
                                <label class="form-check-label" for="thu4">Thứ 4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Thu" id="thu5" name="day_update[]">
                                <label class="form-check-label" for="thu5">Thứ 5</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Fri" id="thu6" name="day_update[]">
                                <label class="form-check-label" for="thu6">Thứ 6</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sat" id="thu7" name="day_update[]">
                                <label class="form-check-label" for="thu7">Thứ 7</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sun" id="thu8" name="day_update[]">
                                <label class="form-check-label" for="thu8">CN</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Link check: </label>
                        <div class="col-sm-10">
                            <a class="btn btn-primary btn-sm addimg" style="margin: 0">+ Thêm link</a>
                        </div>
                    </div>
                    <div class="form-group" id="contentimg">
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Miêu tả: </label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control " id="editor1" value="{{ old('description') }}"></textarea>
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

    $(document).ready(function() {
        $('.addimg').on('click', function(){
            $('#contentimg').append('' +
                '<div class="form-group row">' +
                    '<label class="col-sm-2 col-form-label"></label>' +
                    '<div class="col-sm-8">' +
                        '<input type="text" class="form-control" name="name_link[]" placeholder="Tên">' +
                        '<input type="text" class="form-control" name="link[]" placeholder="Link">' +
                        '<input type="text" class="form-control" name="note_link[]" placeholder="Ghi chú">' +
                    '</div>' +
                '</div>');
        });
    });
</script>
@endsection
