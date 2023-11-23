<?php

namespace App\Http\Controllers;

use App\Models\CustomerService;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class TicketController extends Controller
{
    public function index() {
        $user = auth()->user();
        $reservations = $user->reservations;
        $tickets = CustomerService::where("user_id", $user->id)->paginate(12);

        return view('ticket', ['reservations' => $reservations, 'tickets' => $tickets]);
    }

    public function submit(Request $request) {
        $validator = Validator::make($request->all(), [
            'reservation'=> ['required', Rule::ProhibitedIf($request->reservation == 0), 'exists:reservations,id'],
            'message'=> ['required', 'ascii'],
            'image_path' => ['image','mimes:jpeg,png,jpg,gif','max:2048'],
        ], [
           'reservation'=> 'Choose a reservation'
        ]);

        if($validator->stopOnFirstFailure()->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if(isset($request->image_path)) {
            $image = $request->file('image_path');
            $imgname = $image->getClientOriginalName();
            $imgpath = "public/tickets/";
        }

        else {
            $imgpath = NULL;
        }

        
        //put in database
        CustomerService::create([
            'reservation_id' => $request->reservation,
            'user_id' => auth()->user()->id,
            'image_path' => $imgpath . $imgname,
            'description'=> $request->message,
        ]);

        if(isset($request->image_path)) Storage::putFileAs($imgpath, $image, $imgname);


        Session::flash('success', 'Customer Service ticket sent successfully');
        return redirect()->route('tickets');

    }
}
