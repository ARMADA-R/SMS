<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = ['users','roles','seasons','files','courses','settings'];
        $b = ['browse','edit','delete','add','view'];
        $c =['admin','teacher','student','parents'];

        foreach ($a as $Aval) {
            foreach ($b as $Bval) {
                Permission::create([
                    'name' => $Bval .' '. $Aval,
                    'code' => $Bval .'-'. $Aval,
                    'group' => $Aval
                ]);
            }
        }
        foreach ($c as $Cval) {
            Permission::create([
                'name' => $Cval,
                'code' => str_replace(' ','-' ,$Cval) ,
                'group' => 'general'
            ]);
        }
    }
}
