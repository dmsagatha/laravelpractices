<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    File::cleanDirectory(public_path('storage/avatars'));

    User::factory()->create([
      'name' => 'Super Admin',
      'email' => 'superadmin@admin.net',
      'birthdate' => '2005-08-01',
      'password'  => Hash::make('superadmin'),
    ]);

    // User::factory(10)->create();
  }
}