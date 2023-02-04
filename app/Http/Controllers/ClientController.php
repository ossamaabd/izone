<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Priority;
use App\Models\Service;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function login(Request $request)
    {

        $client = Client::where('phone_number',$request->phone_number)->first();
         if(!$client)
         return response()->json("Credentials is wrong",401);
        // return Hash::check($request->password, $admin->password);
        if(Hash::check($request->password, $client->password))
        {
            $token=$client->createToken('myauth')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message'=>'welcome',
                    'token' => $token
                ],200);




        }
    else
    {
        return response()->json("Credentials is wrong",401);
    }
    }

    public function CreateClient(ClientRequest $requset)
    {
        try {
            $client = new Client();
            $client->name = $requset->name;
            $client->password = Hash::make($requset->password);
            $client->phone_number = $requset->phone_number;
            $client->save();

            return response()->json([
                'status' => true,
                'message' => "you created Client successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function UpdateClient(ClientRequest $requset, $ClientId)
    {
        try {

            $client = Client::find($ClientId);
            if(!$client)
            return response()->json([
                'status' => false,
                'message' => "don't found this Client"

            ],400);

            $client->name = $requset->name;
            $client->password = Hash::make($requset->password);
            $client->phone_number = $requset->phone_number;
            $client->save();

            return response()->json([
                'status' => true,
                'message' => "you updated client successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function DeleteClient($ClientId)
    {
        try {

            $client = Client::find($ClientId);
            if(!$client)
            return response()->json([
                'status' => false,
                'message' => "don't found this Client"

            ],400);

            $client->delete();

            return response()->json([
                'status' => true,
                'message' => "you deleted client successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function GetClients()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Client::select('id', 'name', 'phone_number')
                    ->get()

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function test()
    {
        $technicians_count = DB::select("SELECT SUM(tt.hour_cost) AS hour_cost FROM tickets t INNER JOIN technician_tickets tt   ON t.id = 5");

        $service_price = Service::select('price')->where('id',1)->first();
        // $t = Technician::with(['TechnicianTicket' => function($query )
        // {
        //     $query->where('TicketId',24)->get();

        // }])->where('id', 1)->get();
        $technicians_count = DB::select("SELECT SUM(t.hour_cost) AS hour_cost FROM technicians t INNER JOIN technician_tickets tt  ON t.id = tt.TechnicianId AND tt.TicketId = 15 ");

        return $technicians_count;
    }
}
