<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SuperAdmin\FAQ;
use Database\Seeders\landlord\CreateAdminUserSeeder;
use Database\Seeders\landlord\FAQSeeder;
use Database\Seeders\landlord\FeedBackSeeder;
use Database\Seeders\landlord\PackageDetailsSeeder;
use Database\Seeders\landlord\PackageSeeder;
use Database\Seeders\landlord\PaymentMethodsSeeder;
use Database\Seeders\landlord\SettingSeeder;
use Database\Seeders\landlord\ContactUsSeeder;

use Database\Seeders\landlord\HomeCoverSeeder;
use Database\Seeders\landlord\TechnologySeed;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // tenant
        // $this->call(PermessionDBSeed::class);
        // $this->call(RoleDBSeed::class);
        // $this->call(AdminstratorDBSeed::class);
        // $this->call(SettingDBSeeder::class);
        // $this->call(HomePageMetaDBSeed::class);




// ------------------------------------------------------------------------------------------------
// landlord
        $this->call(CreateAdminUserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageDetailsSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(HomeCoverSeeder::class);
        $this->call(FeedBackSeeder::class);
        $this->call(TechnologySeed::class);
        $this->call(FAQSeeder::class);







// --------------------------------------------------------------------------------------------
     /*   $this->call(UsersDBSeed::class);
        $this->call(CustomerDBSeed::class);
        $this->call(CategoryDBSeed::class);
        $this->call(bannerDBSeed::class);
        $this->call(UnitDBSeed::class);
        $this->call(ProductDBSeed::class);
        $this->call(CouponDBSeed::class);
        $this->call(CategoryMetaDBSeed::class);
        $this->call(OrderDBSeed::class);*/
    }
}
