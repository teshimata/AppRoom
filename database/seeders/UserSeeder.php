<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
Run the database seeds.
     *
@return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Example User',
            'age' => 30,
            'sex' => 1, // 1 が男性、2 が女性を表すと仮定
            'email' => 'example@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('your_password'), // パスワードは適切にハッシュ化する
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}