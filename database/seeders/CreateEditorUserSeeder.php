<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateEditorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Usuario editor', 
            'email' => 'editor@gmail.com',
            'password' => bcrypt('hola1234')
        ]);
    
        $role = Role::create(['name' => 'Editor']);
     
        $permissions = ['5', '6', '7', '8', '9', '11', '13', '14', '15', '16'];
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}