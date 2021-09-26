<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function send(Request $request)
    {
        $this->validate($request, [
            'name'     =>  'required',
            'email'  =>  'required|email',
            'subject' => 'required|max:50',
            'message' =>  'required',

        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->from_email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();

            $contact->user_id = $user->user_id;
        }

        $contact->save();

        $data = array(
            'name'      =>  $request->name,
            'email'     => $request->email,
            'subject'    => $request->subject,
            'message'   =>   $request->message
        );

        // $to_name = 'AllAroundBucks';
        // $to_email = 'allaroundbucks@gmail.com';
        // $from_name =  $request->name;
        // $from_email = $request->email;
        // $subject = $request->subject;

        // $query = Mail::send('emails.contactform', $data, function($message) use ($to_name, $to_email, $subject, $from_name, $from_email) {
        //     $message->to($to_email, $to_name)
        //             ->subject($subject);
        //     $message->from($from_email, $from_name);
        // });

        $query = Mail::to('allaroundbucks@gmail.com')->send(new ContactMail($data));

        if ($query) {
            return redirect('contact-us')->with('success', 'Thanks for contacting us! We will get back to you in a short time.');
        } else {
            return back()->with('fail', 'Something went wrong.');
        }
        // return back()->with('success', 'Thanks for contacting us! We will get back to you in a short time.');
    }
}
