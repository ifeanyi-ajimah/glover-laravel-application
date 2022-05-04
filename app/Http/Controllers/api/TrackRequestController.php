<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TrackRequestService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\TrackRequestResource;
use App\Models\User;
use App\Utils\AppJsonResponse;

class TrackRequestController extends Controller
{
    
    private TrackRequestService $trService;

    public function __construct(){
        $this->trService = new TrackRequestService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theRecords = $this->trService->index();
         
        $data = TrackRequestResource::collection($theRecords);
        
        return AppJsonResponse::successResponse(
            ['theRequests' => $data],
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $newrequest = $this->trService->store($data);

        $payload = new TrackRequestResource( $newrequest );
        return AppJsonResponse::successResponse(
            $payload , "Saved Successfully"
       );

    }

   

    /**
     * Lets you approve the request from the stored request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $approved = $this->trService->approve($id);

        return AppJsonResponse::successResponse(
             "Operation Successful"
       );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterUserRequest $request, $id)
    {
        $data = $request->validated();
        $updaterequest = $this->trService->update($data, $id);

        $payload = new TrackRequestResource( $updaterequest );
        return AppJsonResponse::successResponse(
            $payload , "Updated Stored Successfully"
       );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todelete = $this->trService->destroy($id);
        return AppJsonResponse::successResponse(
             "Deleted Successfully"
       );
    }

}
