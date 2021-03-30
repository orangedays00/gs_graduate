<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->insert([
       [
           'name' => '管理者',
           'email' => 'test@test.com',
           'password' => Hash::make('testtest'),
           'role' =>  '2',
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
        ],
        [
           'name' => 'テストユーザー',
           'email' => 'test1@test.com',
           'password' => Hash::make('testtest'),
           'role' =>  '6',
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
        ],
        [
           'name' => 'テストユーザー2',
           'email' => 'test2@test.com',
           'password' => Hash::make('testtest'),
           'role' =>  '6',
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
        ],
        [
           'name' => 'テストユーザー3',
           'email' => 'test3@test.com',
           'password' => Hash::make('testtest'),
           'role' =>  '6',
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
        ],
        [
           'name' => 'テストユーザー4',
           'email' => 'test4@test.com',
           'password' => Hash::make('testtest'),
           'role' =>  '6',
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
        ],
        ]);
        
        \DB::table('members')->insert([
        [
           'user_id' => 1,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),  
        ],
        [
           'user_id' => 2,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),  
        ],
        [
           'user_id' => 3,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),  
        ],
        [
           'user_id' => 4,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),  
        ],
        [
           'user_id' => 5,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),  
        ],
        ]);
    }
}
