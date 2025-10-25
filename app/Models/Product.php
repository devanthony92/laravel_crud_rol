<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //modelo de producto con soft delete
    use HasFactory, SoftDeletes;

    //definir el guard name para spatie permissions
    protected $guard_name = 'web';

    //definir los campos rellenables
    protected $fillable = ['name', 'description', 'price', 'stock'];
}
