@extends('frontend.partials.master')
@section('title', 'Liên hệ')
@section('content')
<div class="container">
    <br/>
    <div class="col-sm-12 col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
        <div id="contact" class="spacer">
            <!--Contact Starts-->
            <div class="contactform center">
                <h4>Gửi liên hệ để nhận được sự hỗ trợ tốt nhất</h4>
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="row wowload fadeInLeftBig animated" style="visibility: visible;">
                    <div class="col-sm-12 col-xs-12">
                        <form class="form-group" STYLE="  MARGIN-TOP: 34PX;" id="myform" name="contactForm" onsubmit="return validateForm();" method="post" action="{{ route('post_contact') }}">
                            {{ csrf_field() }}
                            <input class="form-control" name="name" id="name" type="text" placeholder="Họ tên">
                            <br>
                            <input class="form-control" name="phone" id="phone" type="number" placeholder="Địện thoại">
                            <br>
                            <input class="form-control" name="email" id="email" type="text" placeholder="Email">
                            <br>
                            <textarea class="form-control" name="content" id="content" rows="5" placeholder="Nội dung"></textarea>
                            <br>
                            <p style="text-align:center;">
                                <button class="btn btn-danger" type="submit" value="Gửi mail" name="save"><i class="fa fa-paper-plane"></i> Gửi email</button>
                            </p>
                        </form>
                    </div>
                </div>
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
                            minlength:8,
                            maxlength:150
                        },
                        email: {
                            required: true,
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
                            required: " <span style='color:#FF0000;'>Xin vui lòng nhập tên công ty của bạn!</span><br />",
                            minlength: " <span style='color:#FF0000;'>Địa chỉ quá ngắn!</span><br />",
                            maxlength: " <span style='color:#FF0000; '>Địa chỉ quá dài!</span><br />",
                        }
                    }
                });
            });
    </script>
@endsection