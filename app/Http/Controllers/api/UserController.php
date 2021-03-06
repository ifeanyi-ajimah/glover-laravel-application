<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\TrackRequest;
use App\Utils\AppJsonResponse;
use App\Mail\RequestApprovedMail;
use App\Mail\RequestDeclinedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store( $request, $request_id )
    {
        $user = User::create($request);
        $trackRequest = TrackRequest::find($request_id);
        $trackRequest->status = 0;
        $trackRequest->save(); 

        $users = User::where('type','admin')->get();
        foreach($users as $user)
        {
        Mail::to($user->email)->send(new RequestApprovedMail($trackRequest, $user));
        }
         
        $payload = new UserResource( $user );
        return AppJsonResponse::successResponse(
            $payload , "Saved Successfully"
       );

    }

  
    public static function update( $request, $request_id, $user_id )
    {
        $user = User::find($user_id);
        $user->update($request);

        $trackRequest = TrackRequest::find($request_id);
        $trackRequest->status = 0;
        $trackRequest->save(); 

        $users = User::where('type','admin')->get();
        foreach($users as $user)
        {
        Mail::to($user->email)->send(new RequestApprovedMail($trackRequest, $user));
        }

        $payload = new UserResource( $user );
        return AppJsonResponse::successResponse(
            $payload , "Saved Successfully"
       );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy($request_id, $user_id)
    {
        $trackRequest = TrackRequest::find($request_id);
        $trackRequest->status = 0;
        $trackRequest->save(); 

        $user = User::find($user_id);
        $user->delete();

        $users = User::where('type','admin')->get();
        foreach($users as $user)
        {
        Mail::to($user->email)->send(new RequestDeclinedMail($trackRequest, $user));
        }

        return AppJsonResponse::successResponse(
             "Deleted Successfully"
       );


    }
}
