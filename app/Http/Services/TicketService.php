<?php

namespace App\Http\Services;

use App\Models\Priority;
use App\Models\Service;
use App\Models\Technician;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketService
{

    public static function GetCostTicket($ticket)
    {


        if($ticket->ClientId != null && $ticket->ServiceId != null && $ticket->PriorityId )
        {
            $ticket->StatusId = 1 ;
        }
        if($ticket->total_working_hours != null && $ticket->TechnicianId != null)
        {
            $ticket->StatusId = 2 ;

        }
        if($ticket->StatusId != null && $ticket->work_report != null && $ticket["client's_notes"] != null  && $ticket["client's_evaluation"] != null && $ticket->total_cost)
        {
            $ticket->StatusId = 3;
        }
        $TicketId = $ticket->id;
        $service_price = Service::select('price')->where('id',$ticket->ServiceId)->first();
        $technicians_count = DB::select("SELECT SUM(t.hour_cost) AS hour_cost FROM technicians t INNER JOIN technician_tickets tt  ON t.id = tt.TechnicianId AND tt.TicketId = $TicketId ");
        $priority_value = Priority::select('value')->where('id',$ticket->PriorityId)->first();

        $ticket->total_cost = $service_price->price + $technicians_count[0]->hour_cost * $priority_value->value;
        $ticket->save();
    }


    public static function CheckDiscount($ticket)
    {

        $TicketId = $ticket->id;

        $evaluation = DB::select("SELECT AVG(ct.evaluation) AS evaluation FROM client_tickets ct WHERE ct.TicketId = $TicketId ");

        if($evaluation[0]->evaluation > 50 && $ticket->IsDiscount == 0)
        {
            $ticket->total_cost = $ticket->total_cost * 0.5;
            $ticket->IsDiscount = 1;
        }

        $ticket["client's_evaluation"] = $evaluation[0]->evaluation;
        $ticket->save();
    }

}
