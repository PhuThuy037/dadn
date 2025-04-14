<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{

    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'building_id','user_id'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function device()
    {
        return $this->hasMany(Device::class);
    }
}
