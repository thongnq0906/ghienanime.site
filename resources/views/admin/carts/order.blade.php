@extends('admin.partials.master')
@section('title', 'Quản lý đơn hàng')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Quản lý đơn hàng</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="post" action="{{ route('admin.cart.checkbox') }}">
                    {{ csrf_field() }}
                    <table id="datatable" class="mb-0 table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkall" name="checkall" /></th>
                                <th>STT</th>
                                <th>Ngày đặt</th>
                                <th>Tên</th>
                                {{-- <th>Thanh toán</th> --}}
                                <th>Tổng tiền</th>
                                {{-- <th>Ghi chú</th> --}}
                                <th>Trạng thái</th>
                                <th>Xử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $key => $c)
                            <tr>
                                <td>
                                    <input type="checkbox" name="checkbox[]" class="checkbox" value="{{ $c->id }}">
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $c->created_at }}</td>
                                <td>{{ $c->name }}</td>
                                {{-- <td>
                                    @if($c->payment == 1)
                                    Ship
                                    @else
                                    Online
                                    @endif
                                </td> --}}
                                <td>{{ $c->total }}</td>
                                {{-- <td>{{ $c->note }}</td> --}}
                                <td>
                                    @if($c->status == 1)
                                    Chờ xử lý
                                    @elseif($c->status == 2)
                                    Đang xử lý
                                    @elseif($c->status == 3)
                                    Hoàn thành
                                    @else
                                    Hủy
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.bill', $c->id)}}">
                                        <i class="pe-7s-look"> </i>
                                    </a>
                                    <a href="{{ route('admin.destroyOrder', $c->id) }}"
                                        type="button"
                                        onclick="return confirm_delete('Bạn có muốn xóa không ?')">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th><input type="checkbox" class="checkall" name="checkall" /></th>
                            <th>STT</th>
                            <th>Ngày đặt</th>
                            <th>Tên</th>
                            {{-- <th>Thanh toán</th> --}}
                            <th>Tổng tiền</th>
                            {{-- <th>Ghi chú</th> --}}
                            <th>Trạng thái</th>
                            <th>Xử lý</th>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type='text/javascript'>
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
</script>
@endsection