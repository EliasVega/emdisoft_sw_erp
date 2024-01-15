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
            'name'  => $row['name'],
            'description' => $row['description'],
            'utility_rate'    => $row['utility_rate'],
            'status'  => $row['status'],
            'company_tax_id' => $this->taxes[$row['company_tax_id']],
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

            // Above is alias for as it always validates in batches
            '*.name'  => 'required|string|unique:categories,name|max:45',
            '*.description' => 'required|string|max:255',
            '*.utility_rate'    => 'required|numeric|between:0,99.99|regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',
            '*.status'  => 'in:active,inactive'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.name' => 'Nombre solo puede llevar 50 caracters',
            'utility_rate.utility_rate' => 'este campo debe ser numerico',
            'status.staus' => 'estado debe ser activo o inactivo'
        ];
    }
}
