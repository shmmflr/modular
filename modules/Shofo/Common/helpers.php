<?php
function feedbacks($title = 'موفقیت آمیز', $body = 'عملیات موفقیت آمیز بود', $icon = 'success')
{
    $sessions = session()->has('msg') ? session()->get('msg') : [];
    $sessions[] = ['title' => $title, 'body' => $body, 'icon' => $icon];

    session()->flash('msg', $sessions);
}

//Icons are => information , error ,warning ,success
