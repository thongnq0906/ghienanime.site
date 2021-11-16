@extends('admin.partials.master')
@section('title', 'Danh mục sản phẩm')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Danh mục sản phẩm</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <a href="{{ route('admin.cate_product.create') }}">
                    <button class="mb-2 mr-2 btn btn-primary"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>Thêm mới</button>
                </a>
                
                @include('errors.message')
                <div class="row">
                    <div class="col-md-12">
                        <table id="datatable" class="mb-0 table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Vị trí</th>
                                    <th>Trạng thái</th>
                                    <th>Cập nhật</th>
                                    <th>Xử lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cate_product as $key => $c)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->position }}</td>
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
                                    <td>{{ $c->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.cate_product.update', $c->slug)}}">
                                            <i class="pe-7s-pen"></i>
                                        </a>
                                        <a href="{{ route('admin.cate_product.destroy', $c->id) }}"
                                            type="button"
                                            onclick="return confirm_delete('Bạn có muốn xóa không ?')">
                                            <i class="pe-7s-close-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style type="text/css">
    body{
    margin:0;
    padding:0;
    background:#f1f1f1;
    /*font:70% Arial, Helvetica, sans-serif;*/
    color:#555;
    line-height:150%;
    text-align:left;
    }
    a{
        text-decoration:none;
        color:#057fac;
    }
    a:hover{
        text-decoration:none;
        color:#999;
    }
    h1{
        font-size:140%;
        margin:0 20px;
        line-height:80px;
    }
    #container{
        margin:0 auto;
        width:680px;
        background:#fff;
        padding-bottom:20px;
        padding-top: 20px;
    }
    #content{margin:0 20px;}
    p{
        margin:0 auto;
        width:680px;
        padding:1em 0;
    }
    #datatable_cate_product{
        font-size: 14px;
    }
</style>
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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

    $(document).on('click', '#status', function(){
        var id = $(this).data('id');
        $.post('{{ route('admin.cate_product.status') }}', {id:id}, function(data){
            console.log(data);
            if (data.status == 1)
            {
                $('#status'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-success">Hiện</span>');
            } else {
                $('#status'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-danger">Ẩn</span>');
            }
        });
    });
</script>
@endsection
