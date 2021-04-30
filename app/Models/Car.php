<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // allowed properties for assignment
    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }

    public function headquarter()
    {
        return $this->hasOne(Headquarter::class);
    }

    public function engines()
    {
        return $this->hasManyThrough(
            Engine::class,
            CarModel::class,
            'car_id',
            'model_id'
        );
    }

    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id',
            'model_id'
        );
    }

    public function products()
    {
        // by default eloquent uses "car_product" name for the intermediate table
        // if the intermediate table is called differently an SQl error is raised
        // to use a custom table name it should be passed to "belongsToMany" method as the second argument
        return $this->belongsToMany(Product::class, 'cars__products');
    }
}
