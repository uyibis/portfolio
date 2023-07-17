<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailer;
use Illuminate\Http\Request;

class contactmeController extends Controller
{
    public function  sendMeMessage(Request $request){
        $request->validate([
                    "name"=>"required",
                    "email"=>"required",
                    "message"=>"required",
                    "subject"=>"required"
        ]);
    $data=[
        "name"=>$request->name,
        "email"=>$request->email,
        "message"=>$request->message,
        "subject"=>"$request->subject"
    ];

    Mail::to("uyibis@gmail.com")->send(new ContactMailer($data));
    }
}
