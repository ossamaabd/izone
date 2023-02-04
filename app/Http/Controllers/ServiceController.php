<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function CreateService(ServiceRequest $requset)
    {
        try {
            $service = new Service();
            $service->title = $requset->title;
            $service->price = $requset->price;
            $service->category = $requset->category;
            $service->save();

            return response()->json([
                'status' => true,
                'message' => "you created Service successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function UpdateService(ServiceRequest $requset, $ServiceId)
    {
        try {

            $service = Service::find($ServiceId);
            if(!$service)
            return response()->json([
                'status' => false,
                'message' => "don't found this Service"

            ],400);

            $service->title = $requset->title;
            $service->price = $requset->price;
            $service->category = $requset->category;
            $service->save();

            return response()->json([
                'status' => true,
                'message' => "you updated service successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function DeleteService($ServiceId)
    {
        try {

            $service = Service::find($ServiceId);
            if(!$service)
            return response()->json([
                'status' => false,
                'message' => "don't found this Service"

            ],400);

            $service->delete();

            return response()->json([
                'status' => true,
                'message' => "you deleted service successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function GetServices()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Service::select('id', 'title', 'price','category')
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
