<?php

namespace App\Models\Roster;

use Illuminate\Database\Eloquent\Model;
use App\Models\Roster\Roster_leave;
use App\Models\Roster\Roster_shift;
use App\Models\User;

class Roster extends Model
{
    protected $table = 'roster'; // 👈 database name
    protected $fillable = [
        'date',
        'user_id',
        'roster_leave_id',
        'roster_shift_id'
    ];
    
    public function leave()
    {
        return $this->belongsTo(Roster_leave::class, 'roster_leave_id', 'id');
    }
    public function shift()
    {
        return $this->belongsTo(Roster_shift::class, 'roster_shift_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
