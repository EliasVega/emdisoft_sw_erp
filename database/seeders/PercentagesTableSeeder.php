<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PercentagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('percentages')->delete();

        DB::table('percentages')->insert(array (
            0 =>
            array(
                'id' =>	1,
                'name' => 'Retencion 0.10% Compras de combustibles',
                'percentage' => '0.10',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Compras de combustibles derivados del petróleo',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            1 =>
            array(
                'id' =>	2,
                'name' => 'Retencion 0.50% Compras de café pergamino o cereza',
                'percentage' => '0.50',
                'base' => 6786000,
                'base_uvt' => 160,
                'concept' => 'Compras de café pergamino o cereza',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            2 =>
            array(
                'id' =>	3,
                'name' => 'Retencion 1% Enajenación de activos fijos',
                'percentage' => '1.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Enajenación de activos fijos de personas naturales (notarías y tránsito son agentes retenedores)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            3 =>
            array(
                'id' =>	4,
                'name' => 'Retencion 1% Compras de vehículos',
                'percentage' => '1.00',
                'base' => 0,
                'base_uvt' =>	0,
                'concept' => 'Compras de vehículos',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            4 =>
            array(
                'id' =>	5,
                'name' => 'Retencion 1% Compras de bienes raíces',
                'percentage' => '1.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Compras de bienes raíces cuya destinación y uso sea vivienda de habitación (por las primeras 20.000 UVT, es decir hasta $726.160.000)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            5 =>
            array(
                'id' =>	6,
                'name' => 'Retencion 1% Servicios de transporte de carga',
                'percentage' => '1.00',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios de transporte de carga',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            6 =>
            array(
                'id' =>	7,
                'name' => 'Retencion 1% Servicios de transporte nacional',
                'percentage' => '1.00',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios de transporte nacional de pasajeros por vía aérea o marítima',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            7 =>
            array(
                'id' =>	8,
                'name' => 'Retencion 1% Servicios prestados (sobre AIU)',
                'percentage' => '1.00',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios prestados por empresas de servicios temporales (sobre AIU)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            8 =>
            array(
                'id' =>	9,
                'name' => 'Retencion 1.50% Compras tarjetas',
                'percentage' => '1.50',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Compras con tarjeta débito o crédito',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            9 =>
            array(
                'id' =>	10,
                'name' => 'Retencion 1.50% Compras de bienes o productos agrícolas',
                'percentage' => '1.50',
                'base' => 3902000,
                'base_uvt' => 92,
                'concept' => 'Compras de bienes o productos agrícolas o pecuarios sin procesamiento industrial',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            10 =>
            array(
                'id' =>	11,
                'name' => 'Retencion 2% Serv. a empresas de vigilancia (sobre AIU)',
                'percentage' => '2.00',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios prestados por empresas de vigilancia y aseo (sobre AIU)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            11 =>
            array(
                'id' =>	12,
                'name' => 'Retencion 2% Serv. int. de salud prestados por IPS',
                'percentage' => '2.00',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios integrales de salud prestados por IPS',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            12 =>
            array(
                'id' =>	13,
                'name' => 'Retencion 2% Contratos construcción y urbanización.',
                'percentage' => '2.00',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Contratos de construcción y urbanización.',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            13 =>
            array(
                'id' =>	14,
                'name' => 'Retencion 2.50% Compras generales (declarantes)',
                'percentage' => '2.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Compras generales (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            14 =>
            array(
                'id' =>	15,
                'name' => 'Retencion 2.50% Productos agrícolas (declarantes)',
                'percentage' => '2.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Compras de bienes o productos agrícolas o pecuarios con procesamiento industrial (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            15 =>
            array(
                'id' =>	16,
                'name' => 'Retencion 2.50% bienes raíces vivienda',
                'percentage' => '2.50',
                'base' =>  848240000,
                'base_uvt' =>	20000,
                'concept' => 'Compras de bienes raíces cuya destinación y uso sea vivienda de habitación (exceso de las primeras 20.000 UVT, es decir superior a $726.160,000)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            16 =>
            array(
                'id' =>	17,
                'name' => 'Retencion 2.50% Compras de bienes raíces',
                'percentage' => '2.50',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Compras de bienes raíces cuya destinación y uso sea distinto a vivienda de habitación',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            17 =>
            array(
                'id' =>	18,
                'name' => 'Retencion 2.50% Ingresos tributarios (declarantes)',
                'percentage' => '2.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Otros ingresos tributarios (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            18 =>
            array(
                'id' =>	19,
                'name' => 'Retención 3% independiente de juegos',
                'percentage' => '3.00',
                'base' => 212000,
                'base_uvt' => 5,
                'concept' => 'Retención en colocación independiente de juegos de suerte y azar',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            19 =>
            array(
                'id' =>	20,
                'name' => 'Retencion 3.50% Compras generales (no declarantes)',
                'percentage' => '3.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Compras generales (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            20 =>
            array(
                'id' =>	21,
                'name' => 'Retencion 3.50% Compras prod. agrícolas (no declarantes)',
                'percentage' => '3.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Compras de bienes o productos agrícolas o pecuarios con procesamiento industrial declarantes (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            21 =>
            array(
                'id' =>	22,
                'name' => 'Retencion 3.50% Emolumentos eclesiásticos (no declarantes)',
                'percentage' => '3.50',
                'base' => 114500,
                'base_uvt' => 27,
                'concept' => 'Por emolumentos eclesiásticos (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            22 =>
            array(
                'id' =>	23,
                'name' => 'Retencion 3.50% Transporte (declarantes)',
                'percentage' => '3.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Servicios de transporte nacional de pasajeros por vía terrestre (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            23 =>
            array(
                'id' =>	24,
                'name' => 'Retencion 3.50% Transporte (no declarantes)',
                'percentage' => '3.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Servicios de transporte nacional de pasajeros por vía terrestre (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            24 =>
            array(
                'id' =>	25,
                'name' => 'Retencion 3.50% Hoteles (declarantes)',
                'percentage' => '3.50',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios de hoteles y restaurantes (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            25 =>
            array(
                'id' =>	26,
                'name' => 'Rtentcion 3.50% Hoteles (no declarantes)',
                'percentage' => '3.50',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios de hoteles y restaurantes (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            26 =>
            array(
                'id' =>	27,
                'name' => 'Retencion 3.50% Arrendamiento de bienes (declarantes)',
                'percentage' => '3.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Arrendamiento de bienes inmuebles (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            27 =>
            array(
                'id' =>	28,
                'name' => 'Arrendamiento de bienes (no declarantes)',
                'percentage' => '3.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Arrendamiento de bienes inmuebles (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            28 =>
            array(
                'id' =>	29,
                'name' => 'Retencion 3.50% ingresos tributarios (no declarantes)',
                'percentage' => '3.50',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Otros ingresos tributarios (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            29 =>
            array(
                'id' =>	30,
                'name' => 'Retencion 3.50% licenciamiento de uso de software',
                'percentage' => '3.50',
                'base' => 0,
                'base_uvt' =>	0,
                'concept' => 'Servicios de licenciamiento o derecho de uso de software',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            30 =>
            array(
                'id' =>	31,
                'name' => 'Retencion 4% Servicios generales (declarantes)',
                'percentage' => '4.00',
                'base' => 170000,
                'base_uvt' =>	4,
                'concept' => 'Servicios generales (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            31 =>
            array(
                'id' =>	32,
                'name' => 'Retencion 4% emolumentos eclesiásticos (declarantes)',
                'percentage' => '4.00',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Por emolumentos eclesiásticos (declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            32 =>
            array(
                'id' =>	33,
                'name' => 'Rtenecion 4% Arrendamiento de bienes muebles',
                'percentage' => '4.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Arrendamiento de bienes muebles',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            33 =>
            array(
                'id' =>	34,
                'name' => 'Rendimientos financieros de títulos de renta fija',
                'percentage' => '4.00',
                'base' => 0,
                'base_uvt' =>	0,
                'concept' => 'Rendimientos financieros provenientes de títulos de renta fija',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            34 =>
            array(
                'id' =>	35,
                'name' => ' Retencion 6% Servicios generales (no declarantes)',
                'percentage' => '6.00',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Servicios generales (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            35 =>
            array(
                'id' =>	36,
                'name' => 'Retencion 7% Intereses o rendimientos financieros',
                'percentage' => '7.00',
                'base' => 0,
                'base_uvt' =>	0,
                'concept' => 'Intereses o rendimientos financieros',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            36 =>
            array(
                'id' =>	37,
                'name' => 'Retencion 10% Honorarios (no declarantes)',
                'percentage' => '10.00',
                'base' => 0,
                'base_uvt' =>	0,
                'concept' => 'Honorarios y comisiones (no declarantes)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            37 =>
            array(
                'id' =>	38,
                'name' => 'Retencion 11% Honorarios (personas jurídicas)',
                'percentage' => '11.00',
                'base' => 0,
                'base_uvt' =>	0,
                'concept' => 'Honorarios y comisiones (personas jurídicas)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            38 =>
            array(
                'id' =>	39,
                'name' => 'Retencion 11% Honorarios',
                'percentage' => '11.00',
                'base' => 0,
                'base_uvt' =>	0,
                'concept' => 'Honorarios y comisiones pagados a personas naturales que suscriban contratos por más de 3.300 Uvt o que la sumatoria de los pagos o abonos en cuenta durante el año gravable superen 3.300 UVT ($119.816.000)',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            39 =>
            array(
                'id' =>	40,
                'name' => 'Retención 15% Iva servicios',
                'percentage' => '15.00',
                'base' => 170000,
                'base_uvt' => 4,
                'concept' => 'Retención en la fuente por Iva en servicios',
                'status' => 'active',
                'tax_type_id' => 5
            ),
            40 =>
            array(
                'id' =>	41,
                'name' => 'Retencion 15% Iva compras',
                'percentage' => '15.00',
                'base' => 1145000,
                'base_uvt' => 27,
                'concept' => 'Retención en la fuente por Iva en compras',
                'status' => 'active',
                'tax_type_id' => 5
            ),
            41 =>
            array(
                'id' =>	42,
                'name' => 'Retencion 20% Loterias',
                'percentage' => '20.00',
                'base' => 2036000,
                'base_uvt' => 48,
                'concept' => 'Loterías, rifas, apuestas y similares',
                'status' => 'active',
                'tax_type_id' => 6
            ),
            42 =>
            array(
                'id' =>	43,
                'name' => 'IVA 19%',
                'percentage' => '19.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Productos con iva del 19%',
                'status' => 'active',
                'tax_type_id' => 1
            ),
            43 =>
            array(
                'id' =>	44,
                'name' => 'IVA 0%',
                'percentage' => '0.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Productos excentos de iva',
                'status' => 'active',
                'tax_type_id' => 1
            ),
            44 =>
            array(
                'id' =>	45,
                'name' => 'INC 8%',
                'percentage' => '8.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Productos con impuesto al consumo',
                'status' => 'active',
                'tax_type_id' => 4
            ),
            45 =>
            array(
                'id' =>	46,
                'name' => 'RETEIVA 50%',
                'percentage' => '50.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Reteiva del 50%',
                'status' => 'active',
                'tax_type_id' => 5
            ),
            46 =>
            array(
                'id' =>	47,
                'name' => 'RETEICA 0.7%',
                'percentage' => '0.70',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Reteica del 0.7%',
                'status' => 'active',
                'tax_type_id' => 7
            ),
            47 =>
            array(
                'id' =>	48,
                'name' => 'Sobretasa Combustibles 0.5%',
                'percentage' => '0.50',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Sobretasa Combustibles 0.5%',
                'status' => 'active',
                'tax_type_id' => 14
            ),
            48 =>
            array(
                'id' =>	49,
                'name' => 'IC datos 2.00%',
                'percentage' => '2.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'IC datos del 2.00%',
                'status' => 'active',
                'tax_type_id' => 8
            ),
            49 =>
            array(
                'id' =>	50,
                'name' => 'TIBBRE 3.00%',
                'percentage' => '3.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'IC datos del 3.00%',
                'status' => 'active',
                'tax_type_id' => 10
            ),
            50 =>
            array(
                'id' =>	51,
                'name' => 'IC Porcentual 1.70%',
                'percentage' => '1.70',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'IC datos del 1.70%',
                'status' => 'active',
                'tax_type_id' => 16
            ),
            51 =>
            array(
                'id' =>	52,
                'name' => 'IVA 10%',
                'percentage' => '10.00',
                'base' => 0,
                'base_uvt' => 0,
                'concept' => 'Productos con iva del 10%',
                'status' => 'active',
                'tax_type_id' => 1
            ),
        ));
    }
}
