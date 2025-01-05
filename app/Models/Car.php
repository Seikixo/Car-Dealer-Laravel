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

    public function review(){
        return $this->hasMany(Reviews::class);
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

    public function scopeDeleteCar($query, $id){
        return $query->where('id', $id)->delete();
    }

    public function scopeFilterCars($query, $filters){
        if(isset($filters['make']) && !empty($filters['make'])){
            $query->where('make', $filters['make']);
        }

        if(isset($filters['model']) && !empty($filters['model'])){
            $query->where('model', $filters['model']);
        }

        if(isset($filters['color']) && !empty($filters['color'])){
            $query->where('color', $filters['color']);
        }

        if(isset($filters['year']) && !empty($filters['year'])){
            $query->where('year', $filters['year']);
        }

        if(isset($filters['price_min']) && !empty($filters['price_min'])){
            $query->where('price', '>=', $filters['price_min']);
        }

        if(isset($filters['price_max']) && !empty($filters['price_max'])){
            $query->where('price', '<=', $filters['price_max']);
        }

        if(isset($filters['status']) && !empty($filters['status'])){
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }

    public function scopeSearchCars($query, $search){
        if(!empty($search)){
            $query->where(function($q) use ($search){
                $q->where('make', 'like', '%'.$search.'%')
                ->orWhere('model', 'like', '%'.$search.'%')
                ->orWhere('color', 'like', '%'.$search.'%')
                ->orWhere('year', 'like', '%'.$search.'%')
                ->orWhere('price', 'like', '%'.$search.'%')
                ->orWhere('status', 'like', '%'.$search.'%');
            });
        }

        return $query->get();
    }

    public function scopeWithFeaturesAndReviews($query, $id){
        return $query->with(['feature', 'review'])->find($id);
    }

    public function scopeWithAvgRating($query){
        return $query->withAvg('review', 'ratings')->get();
    }

}
