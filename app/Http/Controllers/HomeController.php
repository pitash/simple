<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\About;
use App\About_point;
use App\Service;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    public function contactmessageview()
    {
        $messages = Message::paginate(3);
        $deleted_messages = Message::onlyTrashed()->get();
        return view('admin/message/view', compact('messages','deleted_messages'));
    }
    public function contactmessagedelete($message_id)
    {
        Message::where('id', "=", $message_id)->delete();
        return back();
    }
    public function contactmessagemarkasread($message_id)
    {
        Message::where('id', "=", $message_id)->update([
          'message_status' => 2
        ]);
        return back();
    }
    public function contactmessageedit($message_id)
    {
        $old_information = Message::findOrFail($message_id);
        return view('admin/message/edit', compact('old_information'));
    }
    public function contactmessageupdate(Request $request)
    {
          // old php formate
      // $message_id = $_POST['message_id'];
      // $sender_name = $_POST['sender_name'];
      // $sender_email = $_POST['sender_email'];
      // $sender_message = $_POST['sender_message'];

      $request->validate([
        'sender_name' => 'required',
        'sender_email' => 'required|email',
        'sender_message' => 'required'
      ]);

      $message_id = $request->message_id;
      $sender_name = $request->sender_name;
      $sender_email = $request->sender_email;
      $sender_message = $request->sender_message;

      Message::where('id', "=", $message_id)->update([
        'sender_name' => $sender_name,
        'sender_email' => $sender_email,
        'sender_message' => $sender_message,
      ]);
       return redirect('contact/message/view');

    }
    public function contactmessagerestore($message_id)
    {

      Message::onlyTrashed()->where('id', "=", $message_id)->restore();
      return back();
    }
    public function adminabout()
    {
      $abouts = About::all();
      return view('admin/about/view', compact('abouts'));
    }
    public function adminaboutinsert(Request $request)
    {
      $idFormDB = About::insertGetId([
        "about_title" => $request->about_title,
        "about_details" => $request->about_details,
        "about_point" => $request->about_point,
        "created_at" => Carbon::now(),
      ]);
      if ($request->hasFile('about_photo')) {
        $path = $request->file('about_photo')->store('about_images');
       About:: find($idFormDB)->update([
         "about_image" => $path
       ]);
       return back();
      }
      return back();
    }
    public function adminaboutactive($about_id)
    {
      About::where('about_status', 2)->update([
        "about_status" => 1
      ]);
      About::find($about_id)->update([
        "about_status" =>2
      ]);
      return back();
    }
    public function adminaboutedit($about_id)
    {
      $old_information = About::findOrFail($about_id);
      return view('admin/about/edit', compact('old_information'));
    }
    public function adminaboutupdate(Request $request)
    {
      $request->validate([
        'about_title' => 'required',
        'about_details' => 'required',
        'about_point' => 'required'
      ]);

      $about_id = $request->about_id;
      $about_title = $request->about_title;
      $about_details = $request->about_details;
      $about_point = $request->about_point;

      About::where('id', "=", $about_id)->update([
        'about_title' => $about_title,
        'about_details' => $about_details,
        'about_point' => $about_point,
      ]);
       return redirect('/admin/about');
    }
    public function adminaboutpointinsert(Request $request)
    {

      About_point::insert([
        "about_id" => $request->about_id,
        "point" => $request->point,
        "created_at" => Carbon::now(),
      ]);
      return back();
    }
    public function adminservice()
    {
      $services = Service::all();
      return view('admin/service/view', compact('services'));
    }
    public function adminserviceinsert(Request $request)
    {

      $idFormDB = Service::insertGetId([
        "service_title" => $request->service_title,
        "service_details" => $request->service_details,
        "created_at" => Carbon::now(),
      ]);
      if ($request->hasFile('service_photo')) {
        $path = $request->file('service_photo')->store('service_images');
       Service:: find($idFormDB)->update([
         "service_image" => $path
       ]);
       return back();
      }
      return back();
    }
    public function adminservicedeactive($service_id)
    {
      Service::find($service_id)->update([
        "service_status" => 2
      ]);
      return back();
    }
    public function adminserviceactive($service_id)
    {
      Service::find($service_id)->update([
        "service_status" => 1
      ]);
      return back();
    }
}
