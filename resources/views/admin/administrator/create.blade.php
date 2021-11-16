@extends('admin.partials.master')
@section('title', 'Thêm mới')
@section('content')
    <div class="app-main__inner">
        <h5 class="card-title">Thêm mới</h5>
        <div class="main-card mb-3 card">
            <div class="card-body">
                @include('errors.message')
                <form method="POST" action="{{ route('admin.administrator.createPost') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Tên </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Name" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label">Email </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control"
                            placeholder="Name" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-2 control-label">{{ __('Password') }}</label>
                        <div class="col-md-10">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-2 control-label">{{ __('Confirm Password') }}</label>

                        <div class="col-md-10">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Trạng thái: </label>
                        <label class="switch">
                            <input type="checkbox" name="status" value="0">
                            <span class="slider round"></span>
                            <input type="hidden" name="id" value="1">
                        </label>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-success btn">Lưu</button>
                                <a class="btn-default btn"
                                href="{{ route('admin.administrator.create') }}">
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