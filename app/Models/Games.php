<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;
    //protected $connection = 'mysql-api';

    protected $table = 'gamelist';

    /**
     * @var array
     */
    protected $fillable = [
        'game_id',
        'game_name',
        'game_desc',
        'game_provider',
        'disabled',
        'extra_id',
        'type',
        'api_ext'
    ];
}
