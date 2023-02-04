<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianTicket extends Model
{
    use HasFactory;

    protected $table = 'technician_tickets';
    protected $guarded = [];
    public $timestamps = false;

    public function Technicians()
    {
        return $this->belongsTo(Technician::class , 'TechnicianId');
    }
    public function Tickets()
    {
        return $this->belongsTo(Ticket::class,'TicketId');
    }

}
