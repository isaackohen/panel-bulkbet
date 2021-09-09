<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class GameTransactions extends Model
{
    public $timestamps = true;

    use HasFactory;
    //protected $connection = 'mysql-api';

    protected $table = 'gametransactions';
     
    protected $fillable = [
        'id', 'casinoid', 'player', 'ownedBy', 'bet', 'win', 'currency', 'gameid', 'txid', 'created_at', 'type', 'rawdata', 'updated_at', 'created_at'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'ownedBy');
    }
    
}
