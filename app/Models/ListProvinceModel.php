<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProvinceModel extends Model
{
    use HasFactory;

    protected $table = 'list_provinsi';

    protected $fillable = [
        'name'
    ];
}
