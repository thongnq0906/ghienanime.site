@extends('admin.partials.master')
@section('title', 'Danh sách tập phim')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Điều kỳ diệu đã xảy ra</h5>
        <form action="{{ route('post-hack-animehay') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $tap }}" name="sotap">
            <input type="hidden" value="{{ $product_id }}" name="product_id">
            <button>ok</button>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <table class="mb-0 table table-striped table-bordered dataTable no-footer">
                        <thead>
                        <tr>
                            <th>Tập</th>
                            <th>Link1</th>
                            <th>Link2</th>
                            <th>Link3</th>
                            <th>Link4</th>
                        </tr>
                        </thead>
                        <tbody class="banglon">
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <script>
        const sotap = "{{ $tap }}";
        var linkphim = "{{ $link }}";
        fetch(linkphim)
            .then(function(response) {
                response.text().then(function(text) {
                    let a = text.split('<div class="btn-group"><a href="')[1];
                    let link = a.split('"><button class="xemphim">')[0];
                    fetch('https://www.hhninja.xyz/' +link)
                        .then(function(response) {
                            response.text().then(function(text2) {
                                for (let i = 1; i <= sotap; i++) {
                                    $(".banglon").append("" +
                                        "<tr>" +
                                        "<td class=\"tap\">" + i + "<input type='hidden' name='tap[]' value='" + i + "'>" + "</td>" +
                                        "<td class=\"link1"+ i +"\"></td>" +
                                        "<td class=\"link2"+ i +"\"></td>" +
                                        "<td class=\"link3"+ i +"\"></td>" +
                                        "<td class=\"link4"+ i +"\"></td>" +
                                        "</tr>");
                                    //get link1
                                    let z = text2.includes('var link_1_'+ i + ' = "');
                                    if (z === true) {
                                        let c = text2.split('var link_1_'+ i + ' = "')[1];
                                        let link1 = c.split('"')[0];

                                        $(".link1"+ i +"").append(
                                            "<p>"+ link1 +"</p>" +
                                            "<input type='hidden' value='"+ link1 +"' name='link1[]'>"
                                        );
                                    } else {
                                        $(".link1"+ i +"").append(
                                            "<input type='hidden' value='' name='link1[]'>"
                                        );
                                    }
                                    //get link2
                                    let z2 = text2.includes('var link_2_'+ i + ' = "');
                                    if (z2 === true) {
                                        let c = text2.split('var link_2_'+ i + ' = "')[1];
                                        let link2 = c.split('"')[0];

                                        $(".link2"+ i +"").append(
                                            "<p>"+ link2 +"</p>" +
                                            "<input type='hidden' value='"+ link2 +"' name='link2[]'>"
                                        );
                                    } else {
                                        $(".link2"+ i +"").append(
                                            "<input type='hidden' value='' name='link2[]'>"
                                        );
                                    }
                                    //get link3
                                    let z3 = text2.includes('var link_3_'+ i + ' = "');
                                    if (z3 === true) {
                                        let c = text2.split('var link_3_'+ i + ' = "')[1];
                                        let link3 = c.split('"')[0];

                                        $(".link3"+ i +"").append(
                                            "<p>"+ link3 +"</p>" +
                                            "<input type='hidden' value='"+ link3 +"' name='link3[]'>"
                                        );
                                    } else {
                                        $(".link3"+ i +"").append(
                                            "<input type='hidden' value='' name='link3[]'>"
                                        );
                                    }
                                    //get link4
                                    let z4 = text2.includes('var link_4_'+ i + ' = "');
                                    if (z4 === true) {
                                        let c = text2.split('var link_4_'+ i + ' = "')[1];
                                        let link4 = c.split('"')[0];

                                        $(".link4"+ i +"").append(
                                            "<p>"+ link4 +"</p>" +
                                            "<input type='hidden' value='"+ link4 +"' name='link4[]'>"
                                        );
                                    } else {
                                        $(".link4"+ i +"").append(
                                            "<input type='hidden' value='' name='link4[]'>"
                                        );
                                    }
                                }
                            });
                        });
                });
            });
    </script>
@endsection

@section('script')
@endsection
