<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\CompanyTax;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoriesImport implements
    ToModel,
    WithHeadingRow,
    WithBatchInserts,
    WithChunkReading,
    WithValidation
{
    private $taxes;

    public function __construct()
    {
        $this->taxes = CompanyTax::pluck('id', 'name');
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'name'  => $row['nombre'],
            'description' => $row['descripcion'],
            'utility_rate'    => $row['utilidad'],
            'status'  => $row['estado'],
            'company_tax_id' => $this->taxes[$row['impuesto']],
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

    public function rules(): array
    {
        return [

            // Above is alias for as it always validates in batches
            '*.nombre'  => 'required|string|unique:categories,name|max:45',
            '*.descripcion' => 'required|string|max:255',
            '*.utilidad'    => 'required|numeric|between:0,99.99|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.estado'  => 'in:active,inactive'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nombre.name' => 'Nombre solo puede llevar 50 caracters',
            'utilidad.utility_rate' => 'este campo debe ser numerico',
            'estado.status' => 'estado debe ser activo o inactivo'
        ];
    }
}
