<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $guarded = [];
//     protected $fillable = [
//         'ClientId','PriorityId',
//         'StatusId','creation_date',
//         'total_working_hours','TechnicianId',
//         'work_report','work_completion_date',
//         "client's_notes","client's_evaluation",
//         'total_cost','ServiceId'
// ];
    public $timestamps = false;

    public function Technicians()
    {
        return $this->belongsToMany(Technician::class,'technician_tickets','TechnicianId','TicketId','id','id')->withPivot('hour_cost')->as('technician_tickets');
    }
    public function TechnicianTicket()
    {
        return $this->hasMany(TechnicianTicket::class, 'TicketId');
    }

    public function Clients()
    {
        return $this->belongsToMany(Client::class,'client_tickets','ClientId','TicketId','id','id')->withPivot('evaluation')->as('client_tickets');
    }
    public function ClientTicket()
    {
        return $this->hasMany(ClientTicket::class, 'TicketId');
    }

    public function Client()
    {
        return $this->belongsTo(Client::class , 'ClientId');
    }
    public function Priority()
    {
        return $this->belongsTo(Priority::class , 'PriorityId');
    }
    public function Status()
    {
        return $this->belongsTo(Status::class , 'StatusId');
    }
    public function Service()
    {
        return $this->belongsTo(Service::class , 'ServiceId');
    }

}
