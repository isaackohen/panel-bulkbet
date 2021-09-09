<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class GameOptions extends Model
{
        public $timestamps = true;

    use HasFactory;

    public static $model = \App\GameOptions::class;

    public static function label()
    {
        return 'Callback Options';
    }
    
    public static $group = "Games API"; 

        use HasFactory;
    //protected $connection = 'mysql-api';

    protected $table = 'gameoptions';
     
    protected $fillable = [
        'id', 'apikey', 'operator', 'operatorurl', 'livecasino_prefix', 'slots_prefix', 'evoplay_prefix', 'poker_prefix', 'bankgroup', 'bankgroupeur', 'bonusbankgroup', 'bonusgroupeur', 'callbackurl', 'sessiondomain', 'statichost', 'ggr', 'created_at', 'updated_at', 'newevoplay', 'livecasino_enabled', 'arcade_enabled'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'ownedBy');
    }
    
}
