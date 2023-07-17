<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactmeController extends Controller
{
    public function  sendMeMessage(Request $request){

        $request->validate([
                    "name"=>"required",
                    "email"=>"required",
                    "msg"=>"required",
                    "subject"=>"required"
        ]);
        //echo "hello";
    $data=[
        "name"=>$request->name,
        "email"=>$request->email,
        "message"=>$request->msg,
        "subject"=>"$request->subject"
    ];

    Mail::to("uyibis@gmail.com")->send(new ContactMailer($data));
    return ["status"=>1, "message"=>"thanks for contacting me"];
    }
}
