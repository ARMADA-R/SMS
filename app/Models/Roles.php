<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Roles extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];


    public function getRolePermissionsAsCodesArray()
    {

        $permissions = DB::table('permissions')->select([
            'permissions.code as code'
        ])
            ->Join('role__permissions', 'role__permissions.permission_id', '=', 'permissions.id')
            ->where('role__permissions.role_id', $this->id)
            ->get()->toArray();


        foreach ($permissions as $key =>  $value) {
            $permissions[$key] = $value->code;
        }

        return ($permissions);
    }
}
