@extends('admin.partials.master')
@section('title', 'Ảnh + Slide')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Ảnh + Slide</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <a href="{{ route('admin.slide.create') }}">
                    <button class="mb-2 mr-2 btn btn-primary"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>Thêm mới</button>
                </a>
                @include('errors.message')
                <table class="mb-0 table table-striped table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Xuất hiện</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th>Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slide as $key => $c)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td style="width: 30%;">
                                <img src="{{ asset($c->image) }}" style="height: 60px; width: 120px;">
                            </td>
                            <td>
                                @if($c->dislay == 1)
                                    {{ "Slide" }}
                                @elseif($c->dislay == 2)
                                    {{ "Logo" }}
                                @else
                                    {{ "Banner"}}
                                @endif
                            </td>
                            <td>{{ $c->position }}</td>
                            <td>
                                @if($c->status == 1)
                                    <a href="#" title="Ẩn" id="status" data-id="{{ $c->id }}">
                                        <span id="status{{ $c->id }}"><span class="label label-success">Hiện</span></span>
                                    </a>
                                @else
                                    <a href="#" title="Hiện" id="status" data-id="{{ $c->id }}">
                                        <span id="status{{ $c->id }}"><span class="label label-danger">Ẩn</span></span>
                                    </a>
                                @endif
                            </td>
                            <td>{{ $c->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.slide.update', $c->id)}}">
                                    <i class="pe-7s-pen"></i>
                                </a>
                                <a href="{{ route('admin.slide.destroy', $c->id) }}"
                                    type="button"
                                    onclick="return confirm_delete('Bạn có muốn xóa không ?')">
                                    <i class="pe-7s-close-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Xuất hiện</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                            <th>Xử lý</th>
                        </tr>
                    </tfoot>
                </table>
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
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '#status', function(){

        var id = $(this).data('id');
        $.post('{{ route('admin.slide.status') }}', {id:id}, function(data){
            if (data.status == 1)
            {
                $('#status'+id).html('<span class="label label-success">Hiện</span>');
            } else {
                $('#status'+id).html('<span class="label label-danger">Ẩn</span>');
            }
        });
    });
</script>
@endsection