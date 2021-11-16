@extends('admin.partials.master')
@section('title', 'Sửa danh mục sản phẩm')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Sửa danh mục sản phẩm</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form role="form" class="form-horizontal" method="POST" action="{{ route('admin.cate_product.postUpdate', $cate_product->slug) }}"enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="control-label col-sm-2">Tên danh mục: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $cate_product->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">Danh mục</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="parent_id">
                                <option value="{{ $cate_product->parent_id }}">
                                    {{ $cate_product->name }}
                                </option>
                                <option value="0">
                                    Danh mục cha
                                </option>
                                <?php  menu($data);?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-2">Ảnh bìa: </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image" value="{{ $cate_product->image }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                            <img src="{{asset($cate_product->image)}}" height="50px" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-2">Trạng thái: </label>
                        <div class="col-sm-10">
                            <label class="switch">
                                <input type="checkbox" name="status"
                                value="0" {{($cate_product->status)?'checked':''}}>
                                <span class="slider round"></span>
                                <input type="hidden" name="id" value="1">
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-2">Miêu tả: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="description" value="{{ $cate_product->description }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-2">Vị trí: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="position" value="{{ $cate_product->position }}">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn" href="{{ route('admin.cate_product.home') }}">
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
<script type="text/javascript">
</script>
@endsection
