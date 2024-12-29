<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Car extends Model
{
    use HasFactory;
    protected $fillable = ['make', 'model', 'color', 'year', 'price', 'status'];

    public function feature(){
        return $this->hasMany(Feature::class);
    }

    public function scopeGetCars($query){
        return $query->get();
    }

    public function scopeGetCar($query, $id){
        return $query->find($id);
    }

    public function scopeCreateCar($query, $data){
        return $query->create($data);
    }

    public function scopeUpdateCar($query, $id, $data){
        return $query->where('id', $id)->update($data);
    }

}
