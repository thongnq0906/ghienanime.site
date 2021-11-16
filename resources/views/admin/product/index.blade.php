@extends('admin.partials.master')
@section('title', 'Danh sách phim')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Danh sách phim</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <a href="{{ route('admin.product.create') }}">
                    <button class="mb-2 mr-2 btn btn-primary"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>Thêm mới</button>
                </a>
                @include('errors.message')
                <form method="post" action="{{ route('checkbox') }}">
                    {{ csrf_field() }}
                    <table id="datatable" class="mb-0 table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên phim</th>
                                <th>Trạng thái</th>
                                <th>SP home</th>
                                <th>Tình trạng</th>
                                <th>Cập nhật</th>
                                <th>Xử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $key => $c)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ route('admin.product.episode.index', $c->id)}}">{{ $c->name }}</a></td>
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
                                <td>
                                    @if($c->check_full == 1)
                                        <a>
                                            <span class="mb-2 mr-2 badge badge-pill badge-success">Full</span>
                                        </a>
                                    @else
                                        @php
                                            $lastEp = \App\Models\Images::where('product_id', $c->id)->orderBy('ep', 'DESC')->first();
                                        @endphp
                                        <a>
                                            <span class="mb-2 mr-2 badge badge-pill badge-danger">
                                                @if($lastEp) Tập {{ $lastEp->ep }} @else Coming soon @endif
                                            </span>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $c->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.product.update', $c->id)}}">
                                        <i class="pe-7s-pen"></i>
                                    </a>
                                    <a href="{{ route('admin.product.destroy', $c->id) }}"
                                        type="button"
                                        onclick="return confirm_delete('Không hối hận ?')">
                                        <i class="pe-7s-close-circle"></i>
                                    </a>
                                    <a href="{{ route('admin.product.episode.index', $c->id)}}">
                                        <i class="pe-7s-check"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên phim</th>
                                <th>Trạng thái</th>
                                <th>SP home</th>
                                <th>Tình trạng</th>
                                <th>Cập nhật</th>
                                <th>Xử lý</th>
                            </tr>
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
    $(document).on('click', '#status', function(){
        var id = $(this).data('id');
        $.post('{{ route('admin.product.status') }}', {id:id}, function(data){
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
        $.post('{{ route('admin.product.is_home') }}', {id:id}, function(data){
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
