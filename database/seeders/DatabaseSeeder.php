<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Unit;
use App\Models\User;
use App\Models\Product;
use App\Models\End;
use App\Models\Size;
use App\Models\Rating;
use App\Models\Valvebrand;
use App\Models\Condi;
use App\Models\Actbrand;
use App\Models\Acttype;
use App\Models\Actsize;
use App\Models\Fail;
use App\Models\Actcond;
use App\Models\Posbrand;
use App\Models\Posmodel;
use App\Models\Poscond;
use App\Models\Uom;
use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        Unit::factory(5)->create();
        End::factory(5)->create();
        Size::factory(5)->create();
        Rating::factory(5)->create();
        Valvebrand::factory(5)->create();
        Condi::factory(5)->create();
        Actbrand::factory(5)->create();
        Acttype::factory(5)->create();
        Actsize::factory(5)->create();
        Fail::factory(5)->create();
        Actcond::factory(5)->create();
        Posbrand::factory(5)->create();
        Posmodel::factory(5)->create();
        Poscond::factory(5)->create();
        Uom::factory(5)->create();

        for ($i=0; $i < 10; $i++) {
            Product::factory()->create([
                'product_code' => IdGenerator::generate([
                    'table' => 'products',
                    'field' => 'product_code',
                    'length' => 4,
                    'prefix' => 'Vlv'
                ]),
            ]);
        }

    }
}
