<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = factory(App\User::class)->create([
      'username' => 'admin',
      'email' => 'admin@admin.com',
      'password' => bcrypt('Admin!123'),
      'firstname' => 'Admin', 
			'lastname' => 'Admin',			 
      'admin' => '1',
      'logged' => '1'
		]);
  }
}