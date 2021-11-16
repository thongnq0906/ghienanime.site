@extends('admin.partials.master')
@section('title', 'Sửa')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Sửa</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.administrator.postUpdate', $administrator->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Tên </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"placeholder="Name" name="name"
                            value="{{ $administrator->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Email </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"placeholder="Name" name="email"
                            value="{{ $administrator->email }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-2 control-label">{{ __('Password mới') }}</label>
                        <div class="col-md-10">
                            <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                        </div>
                    </div>

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn" href="{{ route('admin.administrator.create') }}">
                                    Hủy
                                </a>
                                <a class="btn-default btn" href='javascript:goback()'>Quay lại</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection