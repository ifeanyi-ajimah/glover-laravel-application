<?php 

namespace App\Services;
use App\Models\TrackRequest;
use App\Models\User;
use App\Utils\RequestStatus;
use App\Utils\RequestType;
use App\Utils\CheckAvailability;
use App\Http\Controllers\api\UserController;
use App\Utils\RequestActionPermission;
use Illuminate\Support\Facades\Auth;
use App\Utils\AppJsonResponse;

class TrackRequestService{

    public function index(){
        $allRequest  = TrackRequest::where('status', RequestStatus::Active )->paginate(15);
        return $allRequest ;
    }

    public function store($array){
        $track = TrackRequest::create([
            'request_type' => RequestType::Store,
            'status' => RequestStatus::Active,
            'user_id' =>  null,
            'creator_id' => Auth::id(),
            'request_data' => $array,
        ]);

        return $track;
    }

    public function update($array, $id){

        $track = TrackRequest::create([
            'request_type' => RequestType::Update,
            'status' => RequestStatus::Active,
            'user_id' =>  $id,   //user to be updated
            'creator_id' => Auth::id(),
            'request_data' => $array,
        ]);
        return $track;
    }

    public function destroy($id){

        $user = User::find($id);
        $track = TrackRequest::create([
            'request_type' => RequestType::Delete,
            'status' => RequestStatus::Active,
            'user_id' =>  $id,    //user to be deleted
            'creator_id' => Auth::id(),
            'request_data' => $user,
        ]);
        return $track;

    }

    public function approve($track_request_id){
        $theRequest = TrackRequest::find($track_request_id);
        $user_id = $theRequest->user_id;
        
        CheckAvailability::checkRequestAvailability($theRequest, $theRequest->status); //ensure that a request has not been attended to or that the request exists 

        RequestActionPermission::checkUser($theRequest->creator_id ); //ensures that an admin can not approve his own request

        switch ($theRequest->request_type) {
            case RequestType::Store:
                UserController::store( json_decode($theRequest->request_data), $track_request_id);
            break;
            case RequestType::Update:
                UserController::update( json_decode($theRequest->request_data), $track_request_id, $user_id );
            break;
            case RequestType::Delete:
                UserController::destroy( $track_request_id , $user_id );
            break;
            
            default:
            UserController::store( json_decode($theRequest->request_data), $track_request_id);
        }

    }

    public function decline($id)
    {
        $theRequest = TrackRequest::find($id);
        RequestActionPermission::checkUser($theRequest->creator_id ); 
        
        CheckAvailability::checkRequestAvailability($theRequest, $theRequest->status ); //ensure that a request has not been attended to

        $theRequest->delete();

        return AppJsonResponse::successResponse(
            "Declined Successfully"
      );


    }

}




