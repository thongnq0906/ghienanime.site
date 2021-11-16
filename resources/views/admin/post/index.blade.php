@extends('admin.partials.master')
@section('title', 'Danh sách bài biết')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Danh sách bài biết</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <a href="{{ route('admin.post.create') }}">
                    <button class="mb-2 mr-2 btn btn-primary"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>Thêm mới</button>
                </a>
                @include('errors.message')
                <form method="post" action="{{ route('post.checkbox') }}">
                    {{ csrf_field() }}
                    <table id="datatable" class="mb-0 table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkall" name="checkall" /></th>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên bài viết</th>
                                <th>Danh mục</th>
                                <th>Trạng thái</th>
                                <th>Tin host</th>
                                <th>Cập nhật</th>
                                <th>Xử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($post as $key => $c)
                            <tr>
                                <td>
                                    <input type="checkbox" name="checkbox[]" class="checkbox" value="{{ $c->id }}">
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($c->image) }}"
                                    style="height: 60px; width: 60px;">
                                </td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->Cate_post->name }}</td>
                               <td>
                                    @if($c->status == 1)
                                        <a href="#" title="Ẩn" id="status" data-id="{{ $c->id }}">
                                            <span id="status{{ $c->id }}"><span class="mb-2 mr-2 badge badge-pill badge-success">Hiện</span></span>
                                        </a>
                                    @else
                                        <a href="#" title="Hiện" id="status" data-id="{{ $c->id }}">
                                            <span id="status{{ $c->id }}"><span class="mb-2 mr-2 badge badge-pill badge-danger">Ẩn</span></span>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($c->is_home == 1)
                                        <a href="#" title="Ẩn" id="is_home" data-id="{{ $c->id }}">
                                            <span id="is_home{{ $c->id }}"><span class="mb-2 mr-2 badge badge-pill badge-success">Hiện</span></span>
                                        </a>
                                    @else
                                        <a href="#" title="Hiện" id="is_home" data-id="{{ $c->id }}">
                                            <span id="is_home{{ $c->id }}"><span class="mb-2 mr-2 badge badge-pill badge-danger">Ẩn</span></span>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $c->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.post.update', $c->slug)}}">
                                        <i class="pe-7s-pen"></i>
                                    </a>
                                    <a href="{{ route('admin.post.destroy', $c->id) }}"
                                        type="button"
                                        onclick="return confirm_delete('Bạn có muốn xóa không ?')">
                                        <i class="pe-7s-close-circle"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th><input type="checkbox" class="checkall" name="checkall" /></th>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Tin host</th>
                            <th>Cập nhật</th>
                            <th>Xử lý</th>
                        </tfoot>
                    </table>
                    {{-- <select class="" name="select_action">
                        <option value="0">Lựa chọn</option>
                        <option value="1">Xóa</option>
                        <option value="2">Hiện</option>
                        <option value="3">Ẩn</option>
                    </select>
                    <button id="delete_all" class="btn-success">Thực hiện</button> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('#datatable').DataTable( {
        "oLanguage": {
           "sSearch": "Tìm kiếm",
           "sEmptyTable": "Không có dữ liệu trong bảng",
           "sLengthMenu": 'Hiển thị <select>'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="40">40</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">All</option>'+
                '</select>',
            "sInfo": "Tổng cộng _TOTAL_ mục (_START_ trên _END_)",
            "sInfoFiltered": " - Tìm kiếm từ _MAX_ mục",
         },
        "pageLength": 20,
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value="">Chọn</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .css( 'width', '60px' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
</script>
<script type='text/javascript'>
    $(document).ready(function(){
        $(".checkall").change(function(){
            var checked = $(this).is(':checked');
            if(checked){
                $(".checkbox").each(function(){
                    $(this).prop("checked",true);
                });
            }else{
                $(".checkbox").each(function(){
                    $(this).prop("checked",false);
                });
            }
        });

        $(".checkbox").click(function(){
            if($(".checkbox").length == $(".checkbox:checked").length) {
                $(".checkall").prop("checked", true);
            } else {
                $(".checkall").removeAttr("checked");
            }
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '#status', function(){
        var id = $(this).data('id');
        $.post('{{ route('admin.post.status') }}', {id:id}, function(data){
            if (data.status == 1)
            {
                $('#status'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-success">Hiện</span>');
            } else {
                $('#status'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-danger">Ẩn</span>');
            }
        });
    });
    $(document).on('click', '#is_home', function(){
        var id = $(this).data('id');
        $.post('{{ route('admin.post.is_home') }}', {id:id}, function(data){
            if (data.is_home == 1)
            {
                $('#is_home'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-success">Hiện</span>');
            } else {
                $('#is_home'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-danger">Ẩn</span>');
            }
        });
    });
</script>
@endsection