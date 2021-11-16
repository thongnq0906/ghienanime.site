@extends('admin.partials.master')
@section('title', 'Chi tiết đơn hàng')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Chi tiết đơn hàng</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <div class="row">
                    <div class="col-md-6">
                        <h4 style="border-bottom: 1px solid white; padding-bottom: 5px;">Đơn hàng</h4>
                        <p><strong>ID Đơn hàng : </strong>#DH2</p>
                        <p><strong>Ngày đặt hàng :</strong> {{ $order->created_at }}</p>
                        <p><strong>Tổng tiền :</strong> {{ $order->total }} $</p>
                        {{-- <p><strong>Phương thức thanh toán :</strong>
                            @if($order->payment == 1)
                            Ship
                            @else
                            Online
                            @endif
                        </p> --}}
                    </div>
                    <div class="col-md-6">
                        <h4 style="border-bottom: 1px solid white; padding-bottom: 5px;">Khách hàng</h4>
                        <p><strong>Tên khách hàng :</strong> {{ $order->name }}</p>
                        <p><strong>Địa chỉ giao hàng và thanh toán :</strong> {{ $order->address }}</p>
                        <P><strong>Số điện thoại :</strong> {{ $order->phone }}</p>
                    </div>
                    <form action="{{ route('admin.postStatus', $order->id) }}" method="post">
                        {{ csrf_field() }}
                            <div class="" style="float: left;">
                                <select class="form-control" name="status">
                                    <option {{ $order->status == 1? 'selected' : '' }} value="1">Chờ xử lý</option>
                                    <option {{ $order->status == 2? 'selected' : '' }} value="2">Đang xử lý</option>
                                    <option {{ $order->status == 3? 'selected' : '' }} value="3">Hoàn thành</option>
                                    <option {{ $order->status == 4? 'selected' : '' }} value="4">Hủy</option>
                                </select>
                            </div>
                            <div class="" style="float: left;"><button class="form-control btn-primary">Lưu</button></div>
                    </form>
                </div>
                <div class="row">
                    <table class="mb-0 table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $key => $c)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($c->Product->image) }}" alt="" style="width: 80px; height: 60px;">
                                </td>
                                <td>{{ $c->Product->name }}</td>
                                <td>{{ $c->quantity }}</td>
                                <td>{{ $c->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
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
</script>
@endsection