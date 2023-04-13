<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(30)->create();

        $user = User::factory()->create([
            'name' => 'Jason Gruspe',
            'email' => 'dj.gruspe@gmail.com',
            'password' => '123123'
        ]);

        // you can do Listing:: since this was already imported
        Listing::factory(30)->create(
            [
                'user_id' => $user->id
            ]
        );

        // Listing::create([
        //     'title' => 'SEO Manager',
        //     'tags' => 'laravel, javascript, seo',
        //     'company' => 'Thrive Agency',
        //     'location' => 'Metro Manila',
        //     'email' => 'dj.gruspe@gmail.com',
        //     'website' => 'https://thriveagency.com',
        //     'description' => 'Loram garum sandixas ibni ixis handujas'
        // ]);

        // Listing::create([
        //     'title' => 'Web Developer',
        //     'tags' => 'laravel, magento',
        //     'company' => 'Rize Reviews',
        //     'location' => 'Arlington, TX',
        //     'email' => 'donj.gruspe@gmail.com',
        //     'website' => 'https://rizereviews.com',
        //     'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
        // ]);
    }
}
