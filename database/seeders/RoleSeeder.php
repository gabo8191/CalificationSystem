<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $role3 = Role::create(['name' => 'leader']);

        Permission::create(['name' => 'usuario.edit', 'description' => 'Editar Usuario'])->assignRole($role1);
        Permission::create(['name' => 'usuario.destroy', 'description' => 'Eliminar Usuario'])->assignRole($role1);
        Permission::create(['name' => 'usuario.show', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'pregunta.create', 'description' => 'Crear Pregunta'])->assignRole($role1);
        Permission::create(['name' => 'pregunta.edit', 'description' => 'Editar Pregunta'])->assignRole($role1);
        Permission::create(['name' => 'pregunta.destroy', 'description' => 'Eliminar Pregunta'])->assignRole($role1);
        Permission::create(['name' => 'pregunta.show', 'description' => 'Ver listado de Preguntas'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'formulario.index', 'description' => 'Ver Formulario General'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'resultados', 'description' => 'Ver Resultado Individual'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'resumen', 'description' => 'Ver Resultados Generales'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'partners.create', 'description' => 'Crear Colaborador'])->assignRole($role1);
        Permission::create(['name' => 'partners.edit', 'description' => 'Editar Colaborador'])->assignRole($role1);
        Permission::create(['name' => 'partners.destroy', 'description' => 'Eliminar Colaborador'])->assignRole($role1);
        Permission::create(['name' => 'partners.show', 'description' => 'Ver Listado de Colaboradores'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'teams.create', 'description' => 'Crear Equipo'])->assignRole($role1);
        Permission::create(['name' => 'teams.edit', 'description' => 'Editar Equipo'])->assignRole($role1);
        Permission::create(['name' => 'teams.destroy', 'description' => 'Eliminar Equipo'])->assignRole($role1);
        Permission::create(['name' => 'teams.show', 'description' => 'Ver Listado de Equipos'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'roles.create', 'description' => 'Crear Rol'])->assignRole($role1);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar Rol'])->assignRole($role1);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar Rol'])->assignRole($role1);
        Permission::create(['name' => 'roles.show', 'description' => 'Ver Listado de Roles'])->syncRoles([$role1, $role3]);
    }
}
