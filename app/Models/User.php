<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that have all user permission
     *
     * @var array
     */
    protected $permissions = [];



    public function hasPermission($permission)
    {
        Cache::remember('user-permissions-' . $this->id, \Carbon\Carbon::now()->addSeconds(20), function () {
            return $this->getPermissions();
        });

        return in_array($permission, Cache::get('user-permissions-' . $this->id));

    }



    public function getUserRole()
    {
        return (Roles::find($this->role_id));
    }

    public function getPermissions()
    {
        $user_role = $this->getUserRole();

        if ($user_role) {
            return $user_role->getRolePermissionsAsCodesArray();
        }

        return [];
    }

    public function isClosedAccount()
    {
        if ($this->getAttribute('settings->status') == "active") {
            return false;
        }
        return true;
    }

    // /**
    //  * The channels the user receives notification broadcasts on.
    //  *
    //  * @return string
    //  */
    // public function receivesBroadcastNotificationsOn()
    // {
    //     return 'status-liked';
    // }
}
