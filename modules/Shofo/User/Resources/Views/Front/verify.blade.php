@extends('User::Front.layout.master')

@section('content')
    <div class="account act">
        <form action="{{route('verification.verify')}}" class="form" method="post">
            @csrf
            <a class="account-logo" href="{{route('index')}}">
                <img src="/img/weblogo.png" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">
                    کد تایید را وارد کنید
                </p>
            </div>
            <div class="form-content form-content1">
                <input name="verify_code" class="activation-code-input" placeholder="فعال سازی">
                @error('verify_code')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
                <br>
                <button class="btn i-t">تایید</button>
                <br>

                <a href="#"
                   onclick="event.preventDefault();
                            document.getElementById('resend_code').submit()">
                    ارسال مجدد کد فعال سازی
                </a>

            </div>
            <div class="form-footer">
                <a href="{{route('register')}}">صفحه ثبت نام</a>
            </div>
        </form>
        <form id="resend_code" action="{{route('verification.resend')}}" method="POST">
            @csrf
        </form>
    </div>
@endsection

@section('script')
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>
@endsection
