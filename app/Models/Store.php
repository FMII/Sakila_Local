<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table = 'store';
    protected $primaryKey = 'store_id';
    public $timestamps = false;
    protected $fillable = [
        'manager_staff_id',
        'address_id',
    ];

    public function manager()
    {
        return $this->belongsTo(Staff::class, 'manager_staff_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'store_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'store_id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'store_id');
    }
}
