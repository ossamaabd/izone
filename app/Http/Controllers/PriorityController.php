<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityRequest;
use App\Models\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function CreatePriority(PriorityRequest $requset)
    {
        try {
            $priority = new Priority();
            $priority->title = $requset->title;
            $priority->value = $requset->value;
            $priority->save();

            return response()->json([
                'status' => true,
                'message' => "you created Priority successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function UpdatePriority(PriorityRequest $requset, $PriorityId)
    {
        try {

            $priority = Priority::find($PriorityId);
            if(!$priority)
            return response()->json([
                'status' => false,
                'message' => "don't found this Priority"

            ],400);

            $priority->title = $requset->title;
            $priority->value = $requset->value;
            $priority->save();

            return response()->json([
                'status' => true,
                'message' => "you updated priority successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function DeletePriority($PriorityId)
    {
        try {

            $priority = Priority::find($PriorityId);
            if(!$priority)
            return response()->json([
                'status' => false,
                'message' => "don't found this Priority"

            ],400);

            $priority->delete();

            return response()->json([
                'status' => true,
                'message' => "you deleted priority successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }
    public function GetPriorities()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Priority::select('id', 'title', 'value')
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
