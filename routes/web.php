<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/chat-send', function () {
    event(new \App\Events\ChatSend(request('message'),request('socketId'),request('userName'),request('userId')));
    \App\Message::create([
        'message' => request('message'),
        'user_id' => request('userId')
    ]);
});

Route::post('/register','UserController@register');

Route::post('/login','UserController@login');
Route::post('/authenticate','UserController@authenticate');

Route::post('/message',function(){


    return response()->json(['message' => 'success']);
});


