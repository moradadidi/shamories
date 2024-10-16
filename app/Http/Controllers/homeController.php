<?php

namespace App\Http\Controllers;

use App\Mail\profileMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class homeController extends Controller
{
    public function index(Request $request)
    {
        // Sending a basic test email
        // Mail::to('qRwX5@example.com')->send(new profileMail("morad adidi", "qRwX5@example.com"));

        return view('welcome');
    }
}
