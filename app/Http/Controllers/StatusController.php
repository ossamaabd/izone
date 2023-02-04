<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function CreateStatus(StatusRequest $requset)
    {
        try {
            $status = new Status();
            $status->title = $requset->title;
            $status->save();

            return response()->json([
                'status' => true,
                'message' => "you created Status successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function UpdateStatus(StatusRequest $requset, $StatusId)
    {
        try {

            $status = Status::find($StatusId);
            if(!$status)
            return response()->json([
                'status' => false,
                'message' => "don't found this Status"

            ],400);

            $status->title = $requset->title;
            $status->save();

            return response()->json([
                'status' => true,
                'message' => "you updated status successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function DeleteStatus($StatusId)
    {
        try {

            $status = Status::find($StatusId);
            if(!$status)
            return response()->json([
                'status' => false,
                'message' => "don't found this Status"

            ],400);

            $status->delete();

            return response()->json([
                'status' => true,
                'message' => "you deleted status successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function GetStatuses()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Status::select('id', 'title')
                    ->get()

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
