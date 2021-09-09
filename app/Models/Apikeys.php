<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Apikeys extends Model
{
    use HasFactory;
    //protected $connection = 'mysql-api';

    protected $table = 'apikeys';
     
    protected $fillable = [
        'id', 'apikey', 'operator', 'operatorurl', 'profitToday', 'profitThisWeek', 'profitThisMonth', 'profitCycle', 'bankgroup', 'bankgroupeur', 'bonusgroup', 'bonusgroupeur', 'callbackurl', 'sessiondomain', 'ownedBy', 'type', 'statichost', 'ggr', 'created_at', 'updated_at'
    ];

    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'ownedBy');
    }
    
    public function gameoptions()
    {
        return $this->belongsTo('App\Models\Gameoptions', 'ownedBy');
    }
    
    public function save(array $options = array()) {
        parent::save($options);

        if($this->type == 'games') {
            $key = new Gameoptions();
            $key->apikey = $this->apikey;
            $key->operator = 'example';
            $key->operatorurl = 'example';
            $key->bankgroup = 'usdbank';
            $key->bankgroupeur = 'eurbank';
            $key->bonusbankgroup = 'usdbank_bonus';
            $key->bonusbankgroupeur = 'eurbank_bonus';
            $key->callbackurl = 'example';
            $key->livecasino_prefix = 'livecasino';
            $key->slots_prefix = 'slots';
            $key->evoplay_prefix = 'evoplay';
            $key->poker_prefix = 'poker';
            $key->sessiondomain = '.gambleapi.com';
            $key->statichost = 'static.gambleapi.com';
            $key->ggr = '10';
            $key->save();
        }

    }
    
    public function delete(array $options = array())
    {
        parent::delete($options);
        if($this->type == 'games') {
            PaymentOptions::where('apikey', '=', $this->apikey)->delete();
        }
    }
}
