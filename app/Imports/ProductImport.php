<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Skip empty rows
            if (empty($row['product_name'])) {
                continue;
            }

            Product::create([
                'product_name'     => $row['product_name'],
                'product_model'    => $row['product_model'] ?? null,
                'origin'           => $row['origin'] ?? null,
                'cost_code'        => $row['cost_code'] ?? null,
                'oem'              => $row['oem'] ?? null,
                'cross_reference'  => $row['cross_reference'] ?? null,
                'cost_unit_price'  => $row['cost_unit_price'] ?? null,
                'sale_price_one'   => $row['sale_price_one'] ?? null,
                'sale_price_two'   => $row['sale_price_two'] ?? null,
                'description'      => $row['description'] ?? null,
                'size'             => $row['size'] ?? null,
                // Images are usually uploaded separately, skip for Excel
                'product_image'    => null,
            ]);
        }
    }
}
