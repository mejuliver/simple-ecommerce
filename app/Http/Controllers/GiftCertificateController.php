<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GiftCertificate;

class GiftCertificateController extends Controller
{
    public function index(string $slug){
    }

    public function show(GiftCertificate $GiftCertificate){
        return view('GiftCertificate.gift_certificate',compact('GiftCertificate'));
    }

    public function create(GiftCertificate $GiftCertificate, Request $request){
        $request->validate([
            'sender_name' => 'required|string|max:200',
            'sender_email' => 'required|email:rfc,dns',
            'recipient_name' => 'required|string|max:200',
            'recipient_email' => 'required|email:rfc,dns',
            'type' => 'required',
            'amount' => 'required|numeric'
        ]);

        $GiftCertificate = $GiftCertificate->create([
            'user_id' => Auth::id(),
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'recipient_name' => $request->recipient_name,
            'recipient_email' => $request->recipient_email,
            'type' => $request->type,
            'amount' => $request->amount
        ]);

        return response()->json([ 'success' => true, 'message' => 'Successfully created' ],200);
    }

    public function update(GiftCertificate $GiftCertificate, Request $request){
        $request->validate([
            'sender_name' => 'required|string|max:200',
            'sender_email' => 'required|email:rfc,dns',
            'recipient_name' => 'required|string|max:200',
            'recipient_email' => 'required|email:rfc,dns',
            'type' => 'required',
            'amount' => 'required|numeric'
        ]);

        $GiftCertificate = $GiftCertificate->update([
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'recipient_name' => $request->recipient_name,
            'recipient_email' => $request->recipient_email,
            'type' => $request->type,
            'amount' => $request->amount
        ]);

        return response()->json([ 'success' => true, 'message' => 'Successfully updated' ],200);
    }

    public function create(GiftCertificate $GiftCertificate, Request $request){
        $GiftCertificate->delete();

        return response()->json([ 'success' => true, 'message' => 'Successfully deleted' ],200);
    }
}
