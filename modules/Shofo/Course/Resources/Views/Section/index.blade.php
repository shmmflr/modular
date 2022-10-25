<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    <form action="{{route('sections.store',$course->id)}}" method="post" class="padding-30">
        @csrf
        <x-input type="text" placeholder="عنوان سرفصل" name="title" class="text"/>
        <x-input type="text" placeholder="شماره سرفصل" name="number" class="text"/>
        <button class="btn btn-brand">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->sections as $section)
                <tr role="row" class="">
                    <td><a href="">{{$section->number}}</a></td>
                    <td><a href="">{{$section->title}}</a></td>
                    <td>
                        @can(\Shofo\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSES)

                            @if($section->status == \Shofo\Course\Models\Section::CONFIRMATION_ACCEPT)

                                <a href="" onclick="updateConfirmationStatus(event,
                                    '{{ route('sections.reject', $section->id) }}',
                                    'آیا از رد این آیتم اطمینان دارید؟' , 'رد شده')"
                                   class="item-reject mlg-15" title="رد"></a>

                            @else
                                <a href="" onclick="updateConfirmationStatus(event,
                                    '{{ route('sections.accept', $section->id) }}',
                                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                                   class="item-confirm mlg-15" title="تایید"></a>
                            @endif
                        @endcan
                        <a
                            onclick="deleteItem(event,'{{route('sections.destroy',$section->id)}}')"
                            class="item-delete mlg-15" title="حذف"></a>
                        <a href="{{route('sections.edit',$section->id)}}" class="item-edit " title="ویرایش"></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
