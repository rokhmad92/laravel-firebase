<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PushNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return redirect('/');
    }

    public function create()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $serializedData = $request->input('data');
        $token = $request->input('token');
        parse_str($serializedData, $formData);

        $user = User::create([
            'email' => $formData['email'],
            'password' => bcrypt($formData['password']),
            'deviceToken' => $token
        ]);

        // $fcmTokens = User::whereNotNull('deviceToken')->pluck('deviceToken')->toArray();

        Notification::send(null, new UserNotification($user->deviceToken));
        // Notification::send(null, new PushNotification($request->title, $request->message, $fcmTokens));

        /* or */

        //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

        /* or */

        // Larafirebase::withTitle($request->title)
        //     ->withBody($request->message)
        //     ->sendMessage($fcmTokens);
        // Larafirebase::withTitle('Hello')
        //     ->withBody('Word')
        //     ->sendMessage('dh2Xq1w_YcNElAlivu3znu:APA91bECyXNM64GCZ1X3NtSghWHAIH5qgW5nSE3ncjl6OJ_lFUTUqh-S4kFNJ9n5XFIKxBNBenAu_LL966SKjWOg0-ZdVUMiwqBNo_z-DTQ2inNbokL0Yl4yv3GTy1lOpeCLhoTiFRn_');

        return response()->json([
            'status' => 200
        ]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function notif(Request $request)
    {
        $data = $request->input();
        $fcmTokens = User::whereNotNull('deviceToken')->pluck('deviceToken')->toArray();
        Notification::send(null, new PushNotification($data['title'], $data['isi'], $fcmTokens));
        return back();
    }
}
