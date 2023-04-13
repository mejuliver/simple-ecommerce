<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => \Hash::make('admin')
        ]);
        
        $user_profile = $user->profile()->create([
            'user_id' => $user->id,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);
        
        // create role permission
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'seller']);
        Role::create(['name' => 'vendor']);
        
        $user->assignRole(['superadmin','admin']);
        
        \App\Models\AdminUser::create([
            'user_id' => $user->id
        ]);

        // customer array
        $customers = [
            [
                'first_name' => 'Shella',
                'middle_name' => '',
                'last_name' => 'Astun',
                'email' => 'customer01@domain.com',
                'password' => \Hash::make('password')
            ],
            [
                'first_name' => 'Ricky',
                'middle_name' => 'Oe',
                'last_name' => 'Pomet',
                'email' => 'customer02@domain.com',
                'password' => \Hash::make('password')
            ],
            [
                'first_name' => 'Mechelle',
                'middle_name' => '',
                'last_name' => 'Kampa',
                'email' => 'customer03@domain.com',
                'password' => \Hash::make('password')
            ]
        ];

        foreach( $customers as $customer ){
            // create customer
            $customer_user = \App\Models\User::create(
                [
                    'name' => $customer['first_name'].( $customer['middle_name'] == '' ? '' : ' '.$customer['middle_name'] ).' '.$customer['last_name'],
                    'email' =>  $customer['email'],
                    'password' => \Hash::make('password')
                ]
            );

            $profile = $customer_user->profile()->create([
                'first_name' => $customer['first_name'],
                'middle_name' => $customer['middle_name'],
                'last_name' => $customer['last_name'],
                'email' => $customer['email']
            ]);

            $customer_user->assignRole(['customer','vendor']);

            // create store
            $storeid = 'STR'.( \App\Models\Store::latest('id')->first() ? \App\Models\Store::latest('id')->first()->id+1 : '1' );

            $store = $customer_user->stores()->create([
                'store_id' => $storeid,
                'slug' => $storeid,
                'name' => $customer['first_name'].' store '.$storeid
            ]);

            // create category
            $catid = 'CAT'.( \App\Models\Category::latest('id')->first() ? \App\Models\Category::latest('id')->first()->id+1 : '1' );

            $category = $customer_user->categories()->create(
                [
                    'category_id' => $catid,
                    'slug' => $catid,
                    'name' => $catid
                ]
            );

            // create coupon
            $couponid = 'CPN'.( \App\Models\Coupon::latest('id')->first() ? \App\Models\Coupon::latest('id')->first()->id+1 : '1' );

            $coupon = $customer_user->coupons()->create(
                [
                    'coupon_id' => $couponid,
                    'slug' => $couponid,
                    'name' => $couponid,
                    'expired_date' => '2024-01-01',
                    'percentage' => 5
                ]
            );

            // create brand
            $brandid = 'BRN'.( \App\Models\Brand::latest('id')->first() ? \App\Models\Brand::latest('id')->first()->id+1 : '1' );

            $brand = $customer_user->brands()->create(
                [
                    'brand_id' => $brandid,
                    'slug' => $brandid,
                    'name' => $brandid
                ]
            );

            // create inventory
            $inventoryid = 'INV'.( \App\Models\Inventory::latest('id')->first() ? \App\Models\Inventory::latest('id')->first()->id+1 : '1' );

            $inventory = $customer_user->inventories()->create(
                [
                    'inventory_id' => $inventoryid,
                    'quantity' => 143,
                    'status' => 'in stock'
                ]
            );

            // create manufacturer
            $manufacturerid = 'MFC'.( \App\Models\Manufacturer::latest('id')->first() ? \App\Models\Manufacturer::latest('id')->first()->id+1 : '1' );

            $manufacturer = $customer_user->manufacturers()->create(
                [
                    'manufacturer_id' => $manufacturerid,
                    'slug' => $manufacturerid,
                    'name' => $manufacturerid
                ]
            );


            // create product
            $productid = 'PRD'.( \App\Models\Product::latest('id')->first() ? \App\Models\Product::latest('id')->first()->id+1 : '1' );

            $product = $customer_user->products()->create(
                [
                    'brand_id' => $brand->id,
                    'inventory_id' => $inventory->id,
                    'store_id' => $store->id,
                    'manufacturer_id' => $manufacturer->id,
                    'product_id' => $productid,
                    'name' => $productid,
                    'slug' => $productid,
                    'price' => 245
                ]
            );

        }
        
    }
}
