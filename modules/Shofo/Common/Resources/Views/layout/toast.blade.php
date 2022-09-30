@if(session()->has('msg'))
    @foreach(session()->get('msg') as $message)
        $.toast({
        heading: '{{$message['title']}}',
        text: '{{$message['body']}}',
        showHideTransition: 'slide',
        icon: '{{$message['icon']}}',
        })
    @endforeach
@endif


{{-- https://kamranahmed.info/toast --}}
