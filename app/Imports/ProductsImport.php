<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\MeasureUnit;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements
    ToModel,
    WithHeadingRow,
    WithBatchInserts,
    WithChunkReading,
    WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $categories;
    private $unidades;

    public function __construct()
    {
        $this->categories = Category::pluck('id', 'name');
        $this->unidades = MeasureUnit::pluck('id', 'name');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'code' => $row['code'],
            'name' => $row['name'],
            'price' => $row['price'],
            'sale_price' => $row['sale_price'],
            'stock' => $row['stock'],
            'stock_min' => $row['stock_min'],
            'type_product' => $row['type_product'],
            'status' => $row['status'],
            'imageName' => $row['image_name'],
            'image' => $row['image'],
            'category_id' => $this->categories[$row['category_id']],
            'measure_unit_id' => $this->unidades[$row['measure_unit_id']],
            'created_at'    => $row['created_at'],
            'updated_at'    => $row['updated_at'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            '*.code' => 'required|unique:products,code|max:20',
            '*.name' => 'required|string|max:100',
            '*.price' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.sale_price' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.stock' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.stock_min' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.type_product' => 'required|in:product,service,consumer',
            '*.status' => 'in:active,inactive',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'code.in' => 'Custom message for :Codigo.',
            'name.in' => 'Custom message for :Nombre.',
            'price.in' => 'Custom message for :Precio.',
            'sale_price.in' => 'Custom message for :Precio_venta.',
            'stock.in' => 'Custom message for :Stock.',
            'stock_min.in' => 'Custom message for :Stock.',
            'status.in' => 'Custom message for :Estado.',
            'category_id.in' => 'Custom message for :Categoria.',
            'measure_unit_id.in' => 'Custom message for :U_medida.',
        ];
    }
}
