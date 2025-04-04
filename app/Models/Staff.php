<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{

     use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'staff';
    protected $primaryKey = 'staff_id';
    public $timestamps = false;
    protected $fillable = [
        'first_name',
        'last_name',
        'address_id',
        'picture',
        'email',
        'store_id',
        'active',
        'username',
        'password',
        'rol_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function managedStore()
    {
        return $this->hasOne(Store::class, 'manager_staff_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'staff_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'staff_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'rol_id');
    }
}
