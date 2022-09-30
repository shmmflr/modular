@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('role_permissions.index')}}" title="نقش های کاربری">نقش های کاربری</a></li>
@endsection
@section('content')
    <div class=" padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نقش</th>
                            <th>دسترسی ها</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr role="row" class="">
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <ul>
                                        @foreach($role->permissions as $permission)
                                            <li>
                                                @lang($permission->name)
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href=""
                                       onclick="deleteItem(event,'{{route('role_permissions.destroy',$role->id)}}')"
                                       class="item-delete mlg-15" title="حذف"></a>
                                    <a href="{{route('role_permissions.edit',$role->id)}}" class="item-edit "
                                       title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                @include('RolePermission::create')
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layout.toast')
    </script>
@endsection
