<?php

namespace Database\Seeders;

use App\helpers\Myhelp;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);

       $constantes = Myhelp::CargosYModelos();

        //ex: istrabajador
        foreach ($constantes['nombresDeCargos'] as $value) {

            $$value = Role::create(['name' => $value]);
            $$value->givePermissionTo(['is' . $value]);
        }
      
        $crudCompleto = ['delete', 'update', 'read', 'create'];
        foreach ($constantes['Models'] as $model) {
            foreach ($crudCompleto as $crud) {
                $superadmin->givePermissionTo([$crud . ' ' . $model]);
                $admin->givePermissionTo([$crud . ' ' . $model]);
            }
        }
        $isSomeThing = array_merge(  [ "isSuper", "isAdmin" ], $constantes['isSome']);
        $superadmin->givePermissionTo($isSomeThing);
        unset($isSomeThing[0]);
        $admin->givePermissionTo($isSomeThing);

            //otros
        $trabajador->givePermissionTo([
            'read reporte',  'update reporte',  'create reporte',  // 'delete reporte',
        ]);

        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);
    }
}
