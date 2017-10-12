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
        // $this->call(UsersTableSeeder::class);
        //create admin rules=1
        DB::table('users')->insert([
            ['name' => 'Hai Ninh','email' => 'daoninh@gmail.com','password' => bcrypt('haininh123'), 'rules' => 1],
            ['name' => 'Ngoc Lan','email' => 'ngoclan@gmail.com','password' => bcrypt('ngoclan123'), 'rules' => 1],
            ['name' => 'Ngoc Thuy','email' => 'ngocthuy@gmail.com','password' => bcrypt('ngocthuy123'), 'rules' => 1],
            ['name' => 'Pham Thuong','email' => 'phamthuong@gmail.com','password' => bcrypt('phamthuong123'), 'rules' => 1],
        ]
       );
      
    }
}
