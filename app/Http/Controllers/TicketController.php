<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusActiveRequest;
use App\Http\Requests\StatusDoneRequest;
use App\Http\Requests\StatusPendingRequest;
use App\Http\Requests\TicketRequest;
use App\Http\Services\TicketService;
use App\Models\ClientTicket;
use App\Models\TechnicianTicket;
use App\Models\Ticket;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function CreateTicket(Request $request )
    {
        try {


                if(auth('client')->check())
                $ticket = Ticket::create([
                    'creation_date'=> date('Y-m-d h:i:s'),
                    'ClientId'=> auth('client')->user()->id,
                    'PriorityId' => $request->PriorityId,
                    'ServiceId' => $request->ServiceId,
                    'total_working_hours' => $request->total_working_hours,
                    'StatusId' => $request->StatusId,
                    'work_report' => $request->work_report,
                    'work_completion_date' => $request->work_completion_date,
                    "client's_notes" => $request->input("client's_notes"),
                    "client's_evaluation" => $request->input("client's_evaluation"),
                    'total_cost' => $request->total_cost
                ]);

                else
                $ticket = Ticket::create([
                    'creation_date'=> now()->format('Y-m-d'),
                    'ClientId'=> $request->ClientId,
                    'PriorityId' => $request->PriorityId,
                    'ServiceId' => $request->ServiceId,
                    'total_working_hours' => $request->total_working_hours,
                    'StatusId' => $request->StatusId,
                    'work_report' => $request->work_report,
                    'work_completion_date' => $request->work_completion_date,
                    "client's_notes" => $request->input("client's_notes"),
                    "client's_evaluation" => $request->input("client's_evaluation"),
                    'total_cost' => $request->total_cost,
                    'IsDiscount' => 0
                ]);


            if($request->Technicians)
            {
                $ticket->TechnicianTicket()->createMany($request->Technicians);
            }
            if($request->input("client's_evaluation"))
            {
                $ticket->ClientTicket()->createMany($request->Clients);
            }
            $service_ticket = new TicketService();
            $service_ticket->GetCostTicket($ticket);
            $service_ticket->CheckDiscount($ticket);

            return response()->json([
                'status' => true,
                'message' => "you created Ticket successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function UpdateTicket(Request $request, $TicketId)
    {
        try {

            $ticket = Ticket::find($TicketId);
            if(!$ticket)
            return response()->json([
                'ticket' => false,
                'message' => "don't found this Ticket"

            ],400);
            $technician_tickets = TechnicianTicket::where('TicketId',$TicketId)->get();
            $client_tickets = ClientTicket::where('TicketId',$TicketId)->get();

            $ticket['PriorityId'] = $request->PriorityId;
            $ticket['ServiceId'] = $request->ServiceId;
            $ticket['total_working_hours'] = $request->total_working_hours;
            $ticket['StatusId'] = $request->StatusId;
            $ticket['work_report'] = $request->work_report;
            $ticket['work_completion_date'] = $request->work_completion_date;
            $ticket["client's_notes"] = $request->input("client's_notes");
            $ticket["client's_evaluation"] = $request->input("client's_evaluation");
            $ticket['total_cost'] = $request->total_cost;


            $ticket->save();


            if($request->Technicians)
            {
                for($i = 0 ; $i < count($technician_tickets); $i++)
                {
                    $technician_tickets[$i]->delete();
                }
                $ticket->TechnicianTicket()->createMany($request->Technicians);
            }
            if($request->Clients)
            {
            for($i = 0 ; $i < count($client_tickets); $i++)
            {
                $client_tickets[$i]->delete();
            }
                $ticket->ClientTicket()->createMany($request->Clients);
            }

            $service_ticket = new TicketService();
            $service_ticket->GetCostTicket($ticket);
            $service_ticket->CheckDiscount($ticket);


            return response()->json([
                'status' => true,
                'message' => "you updated ticket successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function DeleteTicket($TicketId)
    {
        try {

            $ticket = Ticket::find($TicketId);
            if(!$ticket)
            return response()->json([
                'status' => false,
                'message' => "don't found this Ticket"

            ],400);

            $ticket->delete();

            return response()->json([
                'status' => true,
                'message' => "you deleted ticket successfully"

            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'ticket' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function GetTickets()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Ticket::select('id', 'name','hour_cost')
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
