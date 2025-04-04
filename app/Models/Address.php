<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $primaryKey = 'address_id';
    public $timestamps = false;
    protected $fillable = [
        'address',
        'address2',
        'district',
        'city_id',
        'postal_code',
        'phone',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'address_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'address_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'address_id');
    }
}
