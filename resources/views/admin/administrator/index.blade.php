@extends('admin.partials.master')
@section('title', 'Quản lý tài khoản')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Quản lý tài khoản</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <a href="{{ route('admin.administrator.create') }}">
                    <button class="mb-2 mr-2 btn btn-primary"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>Thêm mới</button>
                </a>
                @include('errors.message')
                <table class="mb-0 table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Cập nhật</th>
                            <th>Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($administrator as $key => $c)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.administrator.update', $c->id)}}">
                                        <i class="pe-7s-pen"></i>
                                    </a>
                                    <a href="{{ route('admin.administrator.destroy', $c->id) }}"
                                        type="button"
                                        onclick="return confirm_delete('Bạn có muốn xóa không ?')">
                                        <i class="pe-7s-close-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection