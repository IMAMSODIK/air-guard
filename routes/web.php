<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    $data = [
        'pageTitle' => 'Home',
    ];
    return view('dashboard.index', $data);
});

Route::get('/index', function () {
    $data = [
        'pageTitle' => 'Index',
    ];
    return view('index.index', $data);
});

Route::get('/faq', function () {
    $data = [
    'pageTitle' => 'Frequently Asked Question',
    ];
    return view('faq.index', $data);
});

Route::get('/news', function () {
    $data = [
    'pageTitle' => 'News',
    ];
    return view('news.index', $data);
});

Route::get('/developers', function () {
    $data = [
        'pageTitle' => 'Developers',
    ];
    return view('developer.index', $data);
});

Route::redirect('/', '/home');

Route::fallback(function () {
    return redirect('/home');
});

Route::get('/test', function(){
    return view('test');
});