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
    private $units;

    public function __construct()
    {
        $this->categories = Category::pluck('id', 'name');
        $this->units = MeasureUnit::pluck('id', 'name');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Product([
            'code' => $row['codigo'],
            'name' => $row['nombre'],
            'price' => $row['precio_compra'],
            'sale_price' => $row['precio_venta'],
            'commission' => $row['comision'],
            'stock' => $row['stock'],
            'stock_min' => $row['stock_minimo'],
            'type_product' => $row['tipo'],
            'status' => $row['estado'],
            'imageName' => 'noimage.jpg',
            'image' => '/storage/images/products/noimage.jpg',
            'category_id' => $this->categories[$row['categoria']],
            'measure_unit_id' => $this->units[$row['unidad_medida']],
            'created_at'    => $row['creado'],
            'updated_at'    => $row['actualizado'],
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
    /*
    public function rules(): array
    {
        return [
            '*.codigo' => 'required|unique:products,code|max:20',
            '*.nombre' => 'required|string|max:100',
            '*.precio_compra' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.precio_venta' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.stock' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.stock_minimo' => 'required|numeric|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.tipo' => 'required|in:product,service,consumer',
            '*.estado' => 'in:active,inactive',
            '*.unidad_medida' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'codigo.in' => 'Custom message for :Codigo.',
            'nombre.in' => 'Custom message for :Nombre.',
            'precio_compra.in' => 'Custom message for :Precio.',
            'precio_venta.in' => 'Custom message for :Precio_venta.',
            'stock.in' => 'Custom message for :Stock.',
            'stock_minimo.in' => 'Custom message for :Stock.',
            'estado.in' => 'Custom message for :Estado.',
            'categoria.in' => 'Custom message for :Categoria.',
            'unidad_medida.in' => 'Custom message for :U_medida.',
        ];
    }*/
}
