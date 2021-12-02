<?php

use Illuminate\Database\Seeder;
use App\Access;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Access::create([
        	"name" => "reactjs",
            "api_token" => "IlDOhxsiBOEUi6vo4Fwxu8sCH2QO0ZVlH7IbGClqj5GVsRw3c91RVPqj8KtG",
            "access" => "open",
        ]);
    }
}
