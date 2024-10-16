<?php

namespace Database\Seeders\landlord;

use App\Models\SuperAdmin\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::create([
            'main_title' => 'Features',
            'main_description' => 'The most important features of our application',
            'feature_1_title' => 'Feature 1',
            'feature_1_image' => 'feature-1.png',
            'feature_1_description' => 'Feature 1 description',
            'feature_2_title' => 'Feature 2',
            'feature_2_image' => 'feature-2.png',
            'feature_2_description' => 'Feature 2 description',
            'feature_3_title' => 'Feature 3',
            'feature_3_image' => 'feature-3.png',
            'feature_3_description' => 'Feature 3 description',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
