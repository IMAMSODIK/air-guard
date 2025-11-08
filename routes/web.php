<?php

use Illuminate\Support\Facades\Http;
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

Route::get('/zone-ai', function () {
    $data = [
        'pageTitle' => 'Zone AI',
    ];
    return view('ai.index', $data);
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

Route::get('/news', function () {
    $key = env('GNEWS_API_KEY');
    $url = 'https://gnews.io/api/v4/search';

    $response = Http::withoutVerifying()->get($url, [
        'q' => 'air pollution OR air quality OR climate OR environment OR green energy OR clean air',
        'token' => $key,
        'lang' => 'en',
        'max' => 10,
        'from' => now()->subDays(7)->toDateString(),
    ]);

    $json = $response->json();

    if (!isset($json['articles'])) {
        dd($json);
    }

    $articles = $json['articles'];
    $pageTitle = "News";

    return view('news.index', compact('articles', 'pageTitle'));
});

Route::get('/test', function () {
    $data = [
        'pageTitle' => 'Test',
    ];
    return view('test', $data);
});