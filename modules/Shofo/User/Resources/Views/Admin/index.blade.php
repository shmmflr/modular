@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="نقش های کاربری">کاربران</a></li>
@endsection
@section('content')
    <div class=" padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">کاربران</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام و نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>سطح کاربری</th>
                            <th>تاریخ عضویت</th>
                            <th>ای پی</th>
                            {{--                            <th>وضعیت حساب</th>--}}
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr role="row" class="">
                                <td><a href="">{{ $user->id }}</a></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    <ul>
                                        @foreach($user->roles as $userRole)
                                            <li class="deleteable-list-item">
                                                @lang($userRole->name)
                                                <a onclick="deleteItem(event,
                                                    '{{ route('users.removeRole',[$user->id,$userRole->id]) }}',
                                                    'li')
                                                    "
                                                   class="item-delete mlg-15" title="حذف"></a>
                                            </li>
                                        @endforeach
                                        <a href="#add_roles_{{$user->id}}"
                                           class=" item-add "
                                           rel="modal:open">add</a>
                                    </ul>
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->ip }}</td>
{{--                                <td class="confirmation_status">{!! $user->hasVerifiedEmail() ? "<span class='text-success'>تایید شده</span>"  : "<span class='text-error'>تایید نشده</span>" !!}</td>--}}
                                <td>
                                    <a href="" onclick="deleteItem(event, '{{ route('users.destroy', $user->id) }}')"
                                       class="item-delete mlg-15" title="حذف"></a>
                                    <a href="{{ route('users.edit', $user->id) }}" target="_blank"
                                       class="item-edit mlg-15"
                                       title="ویرایش"></a>
                                    {{--                                    <a href=""--}}
                                    {{--                                       onclick="updateConfirmationStatus(event, '{{ route('users.manualVerify', $user->id) }}',--}}
                                    {{--                                           'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"--}}
                                    {{--                                       class="item-confirm mlg-15" title="تایید"></a>--}}
                                </td>
                            </tr>

                            <div id="add_roles_{{$user->id}}" class="modal">
                                <form action="{{route('users.addRole',$user->id)}}"
                                      method="POST"
                                >
                                    @csrf
                                    <select name="role" id="role">
                                        <option value="">یک آیتم انتخاب کنید</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}">
                                                @lang($role->name)
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-answer">افزودن</button>
                                </form>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layout.toast')
        // $('#add_roles').modal();
    </script>

    <!-- jQuery Modal -->
    <script src="{{asset('panel/modal/jquery.modal.min.js')}}"></script>

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('panel/modal/jquery.modal.min.css')}}">
@endsection
