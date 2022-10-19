@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر"> ویرایش کاربر</a></li>
@endsection
@section('content')
    <div class=" padding-0 categories">
        <div class="col-12 bg-white" style="margin-right: auto;margin-left: auto">
            <x-user-photo/>
            <form action="{{route('update.profile')}}"
                  method="POST" class="padding-30"
                  enctype="multipart/form-data">
                @csrf
                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15"
                             placeholder="نام نام خانوادگی" name="name"
                             value="{{auth()->user()->name}}"
                             required
                    />
                    <x-input type="email" placeholder="ایمیل"
                             class="text-left mx-5 mlg-15" name="email"
                             value="{{auth()->user()->email}}"
                             required
                    />
                    <x-input type="text" placeholder="موبایل"
                             class="text-left" name="mobile"
                             value="{{auth()->user()->mobile}}"
                             required
                    />
                </div>
                <div class="d-flex multi-text">
                    <x-input type="text" placeholder="تلگرام"
                             class="text-left mx-5 mlg-15" name="telegram"
                             value="{{auth()->user()->telegram}}"
                    />
                    <x-input type="text" placeholder="اینستاگرام"
                             class="text-left" name="instagram"
                             value="{{auth()->user()->instagram}}"
                    />
                </div>
                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15"
                             placeholder="یوتوب" name="youtube"
                             value="{{auth()->user()->youtube}}"
                    />
                    <x-input type="text" placeholder="لینکدین"
                             class="text-left mx-5 mlg-15" name="linkdin"
                             value="{{auth()->user()->linkdin}}"
                    />
                    <x-input type="text" placeholder="توئیتر"
                             class="text-left" name="twitter"
                             value="{{auth()->user()->twitter}}"
                    />
                </div>
                <div class="d-flex multi-text">
                    @can(\Shofo\RolePermission\Models\Permission::PERMISSION_TEACH)
                        <x-input type="text" class="text-left mlg-15"
                                 placeholder="شماره شبا" name="shaba"
                                 value="{{auth()->user()->shaba}}"
                        />
                        <x-input type="text" placeholder="شماره عابر بانک"
                                 class="text-left mx-5 mlg-15" name="card_number"
                                 value="{{auth()->user()->card_number}}"
                        />
                    @endcan
                    <div class=" w-100 mx-5">
                        <x-input type="text" placeholder="نام کاربری"
                                 class="text-left" name="username"
                                 value="{{auth()->user()->username}}"
                        />
                        <p class="input-help text-left margin-bottom-12" dir="ltr">
                            <a href="{{auth()->user()->userName()}}">
                                {{auth()->user()->userName()}}
                            </a>
                        </p>
                    </div>
                </div>


                <x-input type="password" placeholder="رمز عبور جدید"
                         name="password"
                         value=""/>
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&amp;*()</strong> باشد.</p>


                @can(\Shofo\RolePermission\Models\Permission::PERMISSION_TEACH)
                    <x-text-area value="{{auth()->user()->bio}}"
                                 placeholder="توضیحات" name="bio"/>
                @endcan
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
