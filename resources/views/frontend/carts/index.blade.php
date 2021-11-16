@extends('frontend.partials.master')
@section('title', 'Giỏ hàng')
@section('content')
<div class="container">
    <div class="breadcrumb-box">
        <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            <li><a href="{{ route('index') }}"><span>Trang chủ</span></a></li>
            <li><a href=""><span>Giỏ hàng</span></a></li>
        </ul>
    </div>
    <div class="contencs">
        <div class="chuatiede">
            <h1 class="tieude">Giỏ hàng</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="cart wow">
                    <div class="table-responsive">
                        <form method="post" action="#updatePost/">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="first last">
                                        <th rowspan="1">Ảnh</th>
                                        <th rowspan="1"><span class="nobr">Tên sản phẩm</span></th>
                                        <th colspan="1" class="a-center"><span class="nobr">Giá</span></th>
                                        <th class="a-center" rowspan="1">Số lượng</th>
                                        <th colspan="1" class="a-center">Tổng giá</th>
                                        <th class="a-center" rowspan="1">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($content as $c)
                                    <tr class="first odd">
                                        <td class="image">
                                            <a class="product-image" title=""
                                            href="#/women-s-crepe-printed-black/">
                                                <img width="75" alt="Sample Product" src="{{ asset($c->options->img) }}">
                                            </a>
                                        </td>
                                        <td>
                                            <strong class="product-name">{{ $c->name }}</strong>
                                        </td>
                                        
                                        <td class="a-right">
                                            <p class="giadon">{{ number_format($c->price) }}VNĐ</p>
                                        </td>
        
                                        <td>
                                            <div class="oimkuy">
                                                {{-- <span class="glyphicon glyphicon-minus lcoa" aria-hidden="true"></span> --}}
                                                <input class="form-control nholai update-cart" value="{{ $c->qty }}" type="number" class="form-control" id="qty" name="update-cart" placeholder="Input field" rowId="{{ $c->rowId }}" data-id="{{ $c->id }}">
                                                {{-- <span class="glyphicon glyphicon-plus lcoa" aria-hidden="true"></span> --}}
                                            </div>
        
                                        </td>
                                        <td>
                                            <p class="giadon" id="{{ $c->rowId }}">{{ number_format($c->price * $c->qty,0,',','.') }}</p>
                                        </td>
                                        <td class="a-center last"><a class="button remove-item" title="Xóa" href="{{ route('destroy_cart', $c->rowId) }}"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thanhtien">
                    <div class="thanhtien1">
                        <div class="row">
                            <div class="col-xs-6">
                                Tạm tính:
                            </div>
                            <div class="col-xs-6 TongGiaTriDonHang">
                                <span class="TongGiaTriDonHang">{{ $total }}</span> VNĐ
                            </div>
                        </div>
                    </div>
                    <div class="thanhtien2">
                        <div class="row">
                            <div class="col-xs-6">
                                Thành tiền:
                            </div>
                            <div class="col-xs-6">
                                <span class="giadep TongGiaTriDonHang">{{ $total }}</span> VNĐ <br> 
                                <span class="vat">(Đã bao gồm VAT)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dathang">
                    <a href="{{ route('order') }}">Tiến hành đặt hàng</a>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        // $( ".glyphicon-minus" ).click(function() {
        //     var num = +$("#qty").val() - 1;
        //     $("#qty").val(num);
        // });
        // $( ".glyphicon-plus" ).click(function() {
        //     var num = +$("#qty").val() + 1;
        //     $("#qty").val(num);
        // });
        
        $('.update-cart').on('change', function(){
            var id    = $(this).data('id');
            var qty   = $(this).val();
            var rowId = $(this).attr('rowId');
            // alert(rowId);
            if(qty <= 0){
                alert('Phải lớn 0');
                location.href=""
            } else {
                $.get('cart/update',{id:id,qty:qty,rowId:rowId},function(data){
                    data = JSON.parse(data);
                        console.log(data);
                        $('#' + rowId).html(data.TongTien);
                        $('.TongGiaTriDonHang').html(data.TongGiaTriDonHang);
                    });
            }
        });
    });
</script>
@endsection