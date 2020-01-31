<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Admin account credentials
     */
    const ADMIN = [
        'name' => 'Admin',
        'email' => 'admin@test.loc'
    ];

    /**
     * Fake user seeds count
     */
    const OTHER_USERS_COUNT = 15;

    /**
     * Seeds Users
     *
     * @return void
     */
    public function run()
    {
        $admin = User::whereEmail(self::ADMIN['email'])->first();
        if($admin === null) factory(User::class, 1)->create(self::ADMIN);
        $count = self::OTHER_USERS_COUNT - User::count() + 1; // plus one because admin user
        if($count > 0) factory(User::class, $count)->create();
        $this->command->info('Total users count: ' . User::count());
    }
}
