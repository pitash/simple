<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\About;
use App\About_point;
use App\Service;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function frontpage()
    {
      $about_info = About::where('about_status', 2)->firstOrFail();
      $points = About_point::where('about_id', $about_info->id)->get();
      $services = Service::where('service_status', 1)->orderBy('service_title' , 'asc')->get();
      return view('index', compact('about_info','points','services'));
    }
    public function contactformsubmit()
    {
      $sender_name = $_POST['sender_name'];
      $sender_email = $_POST['sender_email'];
      $sender_message = $_POST['sender_message'];

      Message::insert([
        "sender_name" => $sender_name,
        "sender_email" => $sender_email,
        "sender_message" => $sender_message,
        "created_at" => Carbon::now(),
      ]);

      return back()->with('status', 'Success Fully Insert');
    }


}
