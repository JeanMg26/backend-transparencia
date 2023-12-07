<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = new User;
    $user->name =  "Administrador";
    $user->username =  "admin";
    // $user->username =  "administrador";
    $user->email =  "administrador@gmail.com";
    $user->password =  Hash::make('123456');
    $user->save();
  }
}
