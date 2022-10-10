@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر"> ویرایش کاربر</a></li>
@endsection
@section('content')
    <div class=" padding-0 categories">
        <div class="col-12 bg-white" style="margin-right: auto;margin-left: auto">
            <form action="{{route('users.update',$user->id)}}" method="POST" class="padding-30"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" placeholder="نام نام خانوادگی" name="name"
                             value="{{$user->name}}"
                             required
                    />
                    <x-input type="email" placeholder="ایمیل" class="text-left mx-5 mlg-15" name="email"
                             value="{{$user->email}}"
                             required
                    />
                    <x-input type="text" placeholder="موبایل" class="text-left" name="mobile"
                             value="{{$user->mobile}}"
                             required
                    />
                </div>
                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" placeholder="نام کاربری" name="username"
                             value="{{$user->username}}"
                    />
                    <x-input type="text" placeholder="تلگرام" class="text-left mx-5 mlg-15" name="telegram"
                             value="{{$user->telegram}}"
                    />
                    <x-input type="text" placeholder="اینستاگرام" class="text-left" name="instagram"
                             value="{{$user->instagram}}"
                    />
                </div>
                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" placeholder="یوتوب" name="youtube"
                             value="{{$user->youtube}}"
                    />
                    <x-input type="text" placeholder="لینکدین" class="text-left mx-5 mlg-15" name="linkdin"
                             value="{{$user->linkdin}}"
                    />
                    <x-input type="text" placeholder="توئیتر" class="text-left" name="twitter"
                             value="{{$user->twitter}}"
                    />
                </div>


                <x-select name="status" required>
                    <option value="">وضعیت کاربر</option>
                    @foreach(\Shofo\User\Models\User::$statuses as $status)
                        <option value="{{$status}}"
                                @if($status == $user->status)selected @endif
                        >@lang($status)</option>
                    @endforeach
                </x-select>
                {{--برای مقدار دهی به عکس باید از rel که مد مدل User است استفاده کرد--}}
                <x-file-upload name="image" :value="$user->images"/>

                <x-input type="password" placeholder="رمز عبور جدید" class="text-left" name="password"
                         value=""
                />

                <x-text-area value="{{$user->bio}}" placeholder="توضیحات" name="bio"/>
                <button class="btn btn-brand">بروزرسانی کاربر</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layout.toast')
    </script>
    <script src="{{asset('panel/js/tagsInput.js')}}"></script>
@endsection
