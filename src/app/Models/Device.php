<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status', 'room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
