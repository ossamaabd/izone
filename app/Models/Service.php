<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $guard = [];
    public $timestamps = false;

    public function Tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
