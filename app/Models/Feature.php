<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = ['car_id', 'feature_name'];

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public static function createCarFeature($carId, $featureName){
        return self::create([
            'car_id' => $carId,
            'feature_name' => $featureName
        ]);
    }

    public static function deleteCarFeature($featureId){
        return self::where('id', $featureId)->delete();
    }
}
