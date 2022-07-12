@extends('Dashboard::master')

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
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr role="row" class="">
                                <td><a href="">{{$category->id}}</a></td>
                                <td><a href="">{{$category->title}}</a></td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->parentName()}}</td>
                                <td>
                                    <a href=""
                                       onclick="deleteItem(event,'{{route('category.destroy',$category->id)}}')"
                                       class="item-delete mlg-15" title="حذف"></a>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{route('category.edit',$category->id)}}" class="item-edit "
                                       title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                @include('Category::create')
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        function deleteItem(event, route) {
            event.preventDefault();
            if (confirm('آیا برای حذف اطمینان دارید')) {
                $.post(route, {_method: 'DELETE', _token: "{{csrf_token()}}"})
                    .done(function (response) {
                        event.target.closest('tr').remove();
                        $.toast({
                            heading: 'عملیات موفق',
                            text: response.msg,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                    })
                    .fail(function (response) {
                        $.toast({
                            heading: 'خطا',
                            text: response.msg,
                            showHideTransition: 'fade',
                            icon: 'error'
                        })
                    });
            }
        }
    </script>
@endsection
