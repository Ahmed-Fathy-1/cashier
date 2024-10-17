<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'sub_title' => 'Welcome to you in Sass cashier for Ai solves and web application',
            'description' => 'We are a leading company in providing services.
            You will find a very high performance and awesome collection from professional web developers and Ai programmers work together
             You will find a very high performance and awesome collection from professional web developers and Ai programmers work together',
            'services_image' => 'default-service-image.jpg',
            'service_1_desc' => 'We provide the best AI techniques by professional team to make your management easier.',
            'service_2_desc' => 'We provide the best AI techniques by professional team to make your management easier.',
            'service_3_desc' => 'We provide the best AI techniques by professional team to make your management easier.',
            'packages_numbers_desc' => 'We have created many packages to use and control several services from one place',
            'packages_numbers_number' => 5,
            'clients_numbers_desc' => 'We have clients from different fields as a members in our services and can help them',
            'clients_numbers_number' => 1000,
            'apps_numbers_desc' => 'Our apps have a dynamic,logic and scalable features include clients wishes and order',
            'apps_numbers_number' => 50,
            'info_1' => 'We are a server reusable programs depend on The News strategy AI solution to help companies for getting the target clients and specifying there clients by providing a bunch of the most helper features they can imagine.',
            'info_2' => 'Second piece of important information.',
            'completeness' => 'Our services are complete and reliable.',
            'control' => 'We maintain complete control over our processes.',
            'proficiency' => 'We are proficient in what we do.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
