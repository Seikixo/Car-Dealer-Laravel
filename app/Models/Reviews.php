<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable = ['car_id', 'pros', 'cons', 'ratings'];

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public static function createReviews($car_id, $pros, $cons, $ratings){
        return self::create([
            'car_id' => $car_id,
            'pros' => $pros,
            'cons' => $cons,
            'ratings' => $ratings
        ]);
    }
}
