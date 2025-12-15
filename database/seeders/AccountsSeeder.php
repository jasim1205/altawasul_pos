<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Accounts;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Accounts::insert([
            // ASSETS (1000 series)
            ['code'=>'1000', 'name'=>'Cash', 'type'=>'asset', 'created_at'=>$now, 'updated_at'=>$now],
            ['code'=>'1010', 'name'=>'Bank', 'type'=>'asset', 'created_at'=>$now, 'updated_at'=>$now],
            ['code'=>'1100', 'name'=>'Inventory', 'type'=>'asset', 'created_at'=>$now, 'updated_at'=>$now],
            ['code'=>'1200', 'name'=>'Accounts Receivable', 'type'=>'asset', 'created_at'=>$now, 'updated_at'=>$now],
            ['code'=>'1300', 'name'=>'Input VAT', 'type'=>'asset', 'created_at'=>$now, 'updated_at'=>$now],

            // LIABILITIES (2000 series)
            ['code'=>'2000', 'name'=>'Accounts Payable', 'type'=>'liability', 'created_at'=>$now, 'updated_at'=>$now],
            ['code'=>'2100', 'name'=>'Output VAT', 'type'=>'liability', 'created_at'=>$now, 'updated_at'=>$now],

            // INCOME (4000 series)
            ['code'=>'4000', 'name'=>'Sales Income', 'type'=>'income', 'created_at'=>$now, 'updated_at'=>$now],

            // EXPENSES (5000 series)
            ['code'=>'5000', 'name'=>'Purchase Expense', 'type'=>'expense', 'created_at'=>$now, 'updated_at'=>$now],
        ]);
        
    }
}
