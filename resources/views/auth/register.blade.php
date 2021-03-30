@extends('layouts.app')

@section('title')
    メンバー登録
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <div class="font-weight-bold text-center border-bottom pb-3" style="font-size: 24px">メンバー登録</div>

            <form method="POST" action="{{ route('register') }}" class="p-1">
                @csrf

                <div class="form-group">
                    <label for="name">名前</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ジーズ太郎">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="gs_taro@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="passwordは8文字以上で入力してください">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">権限</label>
                    <input id="role" type="number" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required  placeholder="管理者：2　一般ユーザー：6">
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secondary">
                        アカウント登録
                    </button>
                </div>

                <!--<div>-->
                <!--    アカウントをお持ちの方は<a href="{{ route('login') }}">こちら</a>-->
                <!--</div>-->
            </form>
        </div>
        </div>
        </div>
    </div>
</div>
@endsection
