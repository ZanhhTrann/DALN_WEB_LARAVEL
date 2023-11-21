<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function sendMessage(Request $request)
{
    $email = $request->input('email');
    $message = $request->input('message');

    // Gửi email
    Mail::send('emails.contact', ['message' => $message], function ($mail) use ($email) {
        $mail->from($email, 'User');
        $mail->to('20010760@st.phenikaa-uni.edu.vn')->subject('New Contact Message');
    });

    return redirect()->back()->with('success', 'Message sent successfully!');
}


}
