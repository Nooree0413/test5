<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCalendar extends Model
{
    protected $table = 'events';
    protected $fillable = ['description','date_start','date_end'];
}
