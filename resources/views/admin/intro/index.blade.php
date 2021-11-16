@extends('admin.partials.master')
@section('title', 'Quản lý giới thiệu')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Quản lý giới thiệu</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <a href="{{ route('admin.intro.create') }}">
                    <button class="mb-2 mr-2 btn btn-primary"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>Thêm mới</button>
                </a>
                @include('errors.message')
                <table class="mb-0 table table-striped table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th>Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($intro as $key => $c)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $c->name }}</td>
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
                                <a href="{{ route('admin.intro.update', $c->slug)}}">
                                    <i class="pe-7s-pen"></i>
                                </a>
                                <a href="{{ route('admin.intro.destroy', $c->id) }}"
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
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '#status', function(){
        var id = $(this).data('id');
        $.post('{{ route('admin.intro.status') }}', {id:id}, function(data){
            if (data.status == 1)
            {
                $('#status'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-success">Hiện</span>');
            } else {
                $('#status'+id).html('<span class="mb-2 mr-2 badge badge-pill badge-danger">Ẩn</span>');
            }
        });
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
</script>
@endsection