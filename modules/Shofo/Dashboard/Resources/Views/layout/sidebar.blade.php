<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href=""></a>

    <x-user-photo/>


    <ul>
        @foreach(config('sidebar.items') as $item)
            @if(!array_key_exists('permission',$item) ||
                auth()->user()->hasPermissionTo($item['permission']) ||
                auth()->user()->hasPermissionTo(\Shofo\RolePermission\Models\Permission::PERMISSION_SUPER_ADMIN)
                )
                <li class="item-li {{$item['icon']}}
                @if($item['url']==request()->url()) is-active @endif">
                    <a href="{{$item['url']}}">{{$item['title']}}</a>
                </li>
            @endif

        @endforeach
    </ul>

</div>
