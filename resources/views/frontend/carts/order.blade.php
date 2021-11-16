@extends('frontend.partials.master')
@section('title', 'Mua hàng')
@section('content')

<div class="mauahngcc">
    <div class="container">
                        <h3>Nhập thông tin mua hàng</h3>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div id="contact" class="spacer">
                    <div class="contactform center">
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        <form class="form-group contact" id="myforms" name="contactForm" {{-- onsubmit="return validateForm();" --}} method="post" action="{{ route('postOrder') }}">
                            {{ csrf_field() }}
                            <input class="form-control" name="name" id="name" type="text" placeholder="Họ tên*" required="">
                            <input class="form-control" name="address" id="address" type="text" placeholder="Địa chỉ*" required="">
                            <input class="form-control" name="phone" id="phone" type="number" placeholder="Địện thoại*" required="">
                            <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                            <textarea class="form-control" name="content" id="content" rows="5" placeholder="Ghi chú"></textarea>
                            
                        
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
                                <span class="TongGiaTriDonHang">{{ $total }}</span> Đ
                            </div>
                        </div>
                    </div>
                    <div class="thanhtien2">
                        <div class="row">
                            <div class="col-xs-6">
                                Thành tiền:
                            </div>
                            <div class="col-xs-6">
                                <span class="giadep TongGiaTriDonHang">{{ $total }}</span> Đ <br> 
                                <span class="vat">(Đã bao gồm VAT)</span>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="buttons-set">
                        <button class="btn btn-primary datmua">Xác nhận</button>
                    </div>
                    </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
            $(document).ready(function() {
                $("#myform").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength:3,
                            maxlength:150
                        },
                        email: {
                            email: true,
                            maxlength:150
                        },
                        phone: {
                            required: true,
                            number: true,
                            minlength: 7,
                            maxlength: 15
                        },
                        address: {
                            required: true,
                            minlength:5,
                            maxlength:150
                        }
                    },
                    messages: {
                        name: {
                            required: " <span style='color:#FF0000; '>Xin vui lòng nhập họ tên của bạn!</span><br />",
                            minlength: " <span style='color:#FF0000; '>Họ tên quá ngắn!</span><br />",
                            maxlength: " <span style='color:#FF0000; '>Họ tên quá dài!</span><br />",
                        },
                        phone: {
                            required: " <span style='color:#FF0000; '>Xin vui lòng nhập số điện thoại!</span><br />",
                            number: "<span style='color:#FF0000; '>Số điện thoại chỉ bao gồm các số từ 0 - 9!</span><br />",
                            minlength: "<span style='color:#FF0000; '>Số điện thoại quá ngắn!</span><br />",
                            maxlength: "<span style='color:#FF0000; '>Số điện thoại quá dài!</span><br />",
                        },
                        email: {
                            required: " <span style='color:#FF0000;'>Xin vui lòng nhập email!</span><br />",
                            maxlength: " <span style='color:#FF0000; '>Email quá dài!</span><br />",
                        },
                        address: {
                            required: " <span style='color:#FF0000;'>Xin vui lòng nhập địa chỉ của bạn!</span><br />",
                            minlength: " <span style='color:#FF0000;'>Địa chỉ quá ngắn!</span><br />",
                            maxlength: " <span style='color:#FF0000; '>Địa chỉ quá dài!</span><br />",
                        }
                    }
                });
            });
    </script>
@endsection