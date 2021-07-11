<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use DB;
class Settings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payload'
    ];


    public static function getsettings()
    {
        // dd('hello');
        $settings = Cache::remember( 'settings', \Carbon\Carbon::now()->addSeconds(7200), function () {
            return  json_decode((DB::table('settings')->select(['payload'])->latest()->first())->payload, true);
        });

        return Cache::get('settings');
    }
}
