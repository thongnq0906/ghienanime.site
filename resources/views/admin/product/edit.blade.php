@extends('admin.partials.master')
@section('title', 'Sửa sản phẩm')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Sửa sản phẩm</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.product.postUpdate', $product->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2">Tên sản phẩm: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                            placeholder="Nhập tên" name="name" value="{{ $product->name }}">
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
                        <label class="col-sm-2 control-label">Danh mục: </label>
                        <div class="col-sm-10">
                            <button class="btn-success btn">Lưu</button>
                            <select class="form-control" name="cate_product_id">
                                <option value="{{ $product->cate_product_id }}">{{ $product->Cate_product->name }}</option>
                                <?php  menu($data);?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Ảnh bìa: </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <img src="{{ asset($product->image) }}"
                            style="height: 50px; width: 50px">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Trạng thái: </label>
                        <label class="switch">
                            <input type="checkbox" name="status"
                            {{ ($product->status) ? 'checked': '' }}>
                            <span class="slider round"></span>
                            <input type="hidden" name="id" value="1">
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">SP trang chủ: </label>
                        <label class="switch">
                            <input type="checkbox" name="is_home"
                            {{ ($product->is_home) ? 'checked': '' }}>
                            <span class="slider round"></span>
                            <input type="hidden" name="id" value="1">
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Ngày ra phim: </label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Mon" id="thu" name="day_update[]" @if (in_array('Mon', $day_update)) checked="checked" @endif>
                                <label class="form-check-label" for="thu">Thứ 2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Tue" id="thu3" name="day_update[]" @if (in_array('Tue', $day_update)) checked="checked" @endif>
                                <label class="form-check-label" for="thu3">Thứ 3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Wed" id="thu4" name="day_update[]" @if (in_array('Wed', $day_update)) checked="checked" @endif>
                                <label class="form-check-label" for="thu4">Thứ 4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Thu" id="thu5" name="day_update[]" @if (in_array('Thu', $day_update)) checked="checked" @endif>
                                <label class="form-check-label" for="thu5">Thứ 5</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Fri" id="thu6" name="day_update[]" @if (in_array('Fri', $day_update)) checked="checked" @endif>
                                <label class="form-check-label" for="thu6">Thứ 6</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sat" id="thu7" name="day_update[]" @if (in_array('Sat', $day_update)) checked="checked" @endif>
                                <label class="form-check-label" for="thu7">Thứ 7</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sun" id="thu8" name="day_update[]" @if (in_array('Sun', $day_update)) checked="checked" @endif>
                                <label class="form-check-label" for="thu8">CN</label>
                            </div>
                        </div>
                    </div>
                    @foreach ($check_movie as $c)
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name_link[]" value="{{ $c->name }}">
                                <input type="text" class="form-control" name="link[]" value="{{ $c->link }}">
                                <input type="text" class="form-control" name="note_link[]"  value="{{ $c->note }}">
                            </div>
                        </div>
                    @endforeach


                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Miêu tả: </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" id="editor2">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Title_SEO: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Title SEO"
                            name="title_seo" value="{{ $product->title_seo }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Meta_key: </label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" placeholder="Meta_key"
                            name="meta_key">{{ $product->meta_key }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 control-label">Meta_des: </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" placeholder="Meta_Des"
                            name="meta_des">{{ $product->meta_des }}</textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">

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
    CKEDITOR.replace( 'editor2', {
        filebrowserBrowseUrl: '{{ route('ckfinder-customer') }}',
    } );
    $(document).ready(function() {

            $('#contentimg').append('' +
                '<div class="form-group row">' +
                '<label class="col-sm-2 col-form-label"></label>' +
                '<div class="col-sm-8">' +
                '<input type="text" class="form-control" name="name_link[]" value="tvhay">' +
                '<input type="text" class="form-control" name="link[]" placeholder="Link">' +
                '<input type="text" class="form-control" name="note_link[]" placeholder="Ghi chú">' +
                '</div>' +
                '</div>');

    });
    $('.delImage').on('click',function(){
        id = $(this).data('id');
        if(confirm('Bạn có muốn xóa ?')){
            flag = $(this).parent('label').parent('div.image').hide();
            $.get('{{ route('index') }}/admin/product/delImage/', {id:id},function(data){
            });
        }
    });
</script>
@endsection
