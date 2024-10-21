<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\landlord\AboutUsSeeder;



// use Database\Seeders\landlord\AboutUsSeeder;

use App\Models\SuperAdmin\FAQ;
use Database\Seeders\landlord\CreateAdminUserSeeder;
use Database\Seeders\landlord\FAQSeeder;
use Database\Seeders\landlord\FeatureSeeder;
use Database\Seeders\landlord\FeedBackSeeder;
use Database\Seeders\landlord\MainNeedsSeeder;
use Database\Seeders\landlord\PackageDetailsSeeder;
use Database\Seeders\landlord\PackageSeeder;
use Database\Seeders\landlord\PaymentMethodsSeeder;
use Database\Seeders\landlord\SettingSeeder;
use Database\Seeders\landlord\ContactUsSeeder;

use Database\Seeders\landlord\HomeCoverSeeder;
use Database\Seeders\landlord\SubNeedsSeeder;
use Database\Seeders\landlord\TechnologySeed;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
// ------------------------------------------------------------------------------------------------
// landlord
        $this->call(CreateAdminUserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageDetailsSeeder::class);
        $this->call(AboutUsSeeder::class);

        $this->call(ContactUsSeeder::class);
        $this->call(HomeCoverSeeder::class);
        $this->call(FeedBackSeeder::class);
        $this->call(TechnologySeed::class);
        $this->call(FAQSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(MainNeedsSeeder::class);
        $this->call(SubNeedsSeeder::class);

    }
}
