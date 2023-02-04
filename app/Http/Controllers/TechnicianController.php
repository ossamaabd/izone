<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnicianRequest;
use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function CreateTechnician(TechnicianRequest $requset)
    {
        try {
            $technician = new Technician();
            $technician->name = $requset->name;
            $technician->hour_cost = $requset->hour_cost;
            $technician->save();

            return response()->json([
                'technician' => true,
                'message' => "you created Technician successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'technician' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function UpdateTechnician(TechnicianRequest $requset, $TechnicianId)
    {
        try {

            $technician = Technician::find($TechnicianId);
            if(!$technician)
            return response()->json([
                'technician' => false,
                'message' => "don't found this Technician"

            ],400);

            $technician->name = $requset->name;
            $technician->hour_cost = $requset->hour_cost;
            $technician->save();

            return response()->json([
                'technician' => true,
                'message' => "you updated technician successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'technician' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function DeleteTechnician($TechnicianId)
    {
        try {

            $technician = Technician::find($TechnicianId);
            if(!$technician)
            return response()->json([
                'technician' => false,
                'message' => "don't found this Technician"

            ],400);

            $technician->delete();

            return response()->json([
                'technician' => true,
                'message' => "you deleted technician successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'technician' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function GetTechnicians()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Technician::select('id', 'name','hour_cost')
                    ->paginate(3)

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
