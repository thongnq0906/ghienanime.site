<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mua hàng</title>
    <style type="text/css">
        .page-content {
            padding: 64px 0px;
            text-align: center;
        }

        .page-content h4 {
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="static-content-wrapper">
                <div class="static-content">
                    <div class="page-content">
                        <div class="container-fluid">

                            <div class="vaosp">
                                <h4> XIN CHÚC MỪNG! ĐƠN HÀNG CỦA BẠN ĐÃ ĐẶT THÀNH CÔNG!</h4>
                                <p>
                                    Tiếp theo, nhân viên trung tâm dịch vụ khách hàng sẽ liên hệ với bạn để xác nhận đơn hàng.Hãy đảm bảo điện thoại của bạn luôn bật.
                                </p>
                                <a href="{{ route('index') }}"><i class="fa fa-fw fa-hand-o-right"></i> Quay lại trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        function goback() {
            history.back(-1)
        }
    </script>
</body>
</html>