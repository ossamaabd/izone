<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $table = 'technicians';
    protected $guarded = [];
    public $timestamps = false;


    public function Tickets()
    {
        return $this->belongsToMany(Ticket::class,'technician_tickets','TicketId','TechnicianId','id','id')->withPivot('hour_cost')->as('technician_tickets');
    }

    public function TechnicianTicket()
    {
        return $this->hasMany(TechnicianTicket::class, 'TechnicianId');
    }
}
