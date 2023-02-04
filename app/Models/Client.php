<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'clients';
    protected $guard = [];
    public $timestamps = false;


    public function Tickets()
    {
        return $this->belongsToMany(Ticket::class,'client_tickets','TicketId','ClientId','id','id')->withPivot('evaluation')->as('client_tickets');
    }

    public function ClientTicket()
    {
        return $this->hasMany(ClientTicket::class, 'ClientId');
    }
}
