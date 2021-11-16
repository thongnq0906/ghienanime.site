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
                <a href="{{ route('check_ninja') }}">
                    <button class="mb-2 mr-2 btn btn-primary">Check Ninja</button>
                </a>
                <a href="{{ route('craw_ninja') }}">
                    <button class="mb-2 mr-2 btn btn-primary">Craw Ninja</button>
                </a>
                <a href="{{ route('craw_animehay') }}">
                    <button class="mb-2 mr-2 btn btn-primary">Craw Animehay</button>
                </a>
                <a href="{{ route('create_animehay') }}">
                    <button class="mb-2 mr-2 btn btn-primary">Create Animehay</button>
                </a>
                <a href="{{ route('create_tvhay') }}">
                    <button class="mb-2 mr-2 btn btn-primary">Create TVHay</button>
                </a>
                @include('errors.message')
                    <table id="datatable" class="mb-0 table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên phim</th>
                            <th>Số tập</th>
                            <th>hhninja</th>
                            <th>Tình trạng</th>
                            <th></th>
                            <th>Up phim</th>
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
                                    @if($c->check_full == 1)
                                        <a>
                                            <span class="mb-2 mr-2 badge badge-pill badge-success">Full</span>
                                        </a>
                                    @else
                                        @php
                                            $lastEp = \App\Models\Images::where('product_id', $c->id)->orderBy('ep', 'DESC')->first();
                                        @endphp
                                        <a>
                                            <span class="mb-2 mr-2 badge badge-pill badge-success">
                                                @if($lastEp) Tập {{ $lastEp->ep }} @else Coming soon @endif
                                            </span>
                                        </a>
                                    @endif
                                </td>
                                <td><span class="mb-2 mr-2 badge badge-pill @if($c->ep_ninja > $c->ep) badge-danger @else badge-success @endif">Tập {{ $c->ep_ninja }}</span></td>

                                @php
                                    $check_movie = \App\Models\Check_movie::where('product_id', $c->id)->get();
                                    if ($c->day_update == null || $c->day_update == 'null') {
                                        $zzz = [];
                                    } else {
                                        $zzz = json_decode($c->day_update);
                                    }
                                @endphp
                                <td>
                                    @if (in_array($homnaylathu, $zzz) && $c->status_update == 1)
                                        <span class="mb-2 mr-2 badge badge-pill badge-danger">Cần update</span>
                                    @endif
                                    @if (in_array($homnaylathu, $zzz) && $c->status_update == 2)
                                        <span class="mb-2 mr-2 badge badge-pill badge-success">Đã update</span>
                                    @endif
                                    @if ($c->status_update == 3)
                                        <span class="mb-2 mr-2 badge badge-pill badge-danger">Hoãn</span>
                                    @endif

                                </td>
                                <td>
                                    <form action="{{ route('set_status_update', $c->id) }}" method="post">
                                        @csrf
                                        <select name="status_update" id="">
                                            <option value="1">Cần update</option>
                                            <option value="2">Đã update</option>
                                            <option value="3">Hoãn</option>
                                        </select>
                                        <button>ok</button>
                                    </form>
                                </td>
                                <td>
                                    @foreach ($check_movie as $cc)
                                        <p><a href="{{ $cc->link }}" target="_blank">{{ $cc->name }} ({{ $cc->note }})</a></p>
                                    @endforeach
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
                            <th>Tình trạng</th>
                            <th></th>
                            <th></th>
                            <th>Up phim</th>
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
            "pageLength": 50,
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
