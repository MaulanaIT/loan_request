<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListNationalityModel extends Model
{
    use HasFactory;

    protected $table = 'list_negara';

    protected $fillable = [
        'name'
    ];
}
