<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTicket extends Model
{
    use HasFactory;

    protected $table = 'client_tickets';
    protected $guarded = [];
    public $timestamps = false;

    public function Clients()
    {
        return $this->belongsTo(Client::class , 'ClientId');
    }
    public function Tickets()
    {
        return $this->belongsTo(Ticket::class,'TicketId');
    }

}
