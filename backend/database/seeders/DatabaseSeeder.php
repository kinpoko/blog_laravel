<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //一括削除
         User::truncate();

         //特定のデータを追加
         User::create([
             'name' => 'test1',
             'email' => 'test1@test.com',
             'password' =>Hash::make('testtest')
         ]);
    }
}
