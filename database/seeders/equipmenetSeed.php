<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class equipmenetSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipment::create(
            [
                'name' => 'Proyector 1',
                'detalle' => 'Epson Power Lite x27 INV 330939',
                'cantidad' => '1'
            ]
        );

        Equipment::create(
            [
                'name' => 'Proyector 2',
                'detalle' => 'Epson Power Lite x27 INV 330940',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector 3',
                'detalle' => 'Epson Power Lite x17 INV 316361',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector 4',
                'detalle' => 'Epson Power Lite x27 INV 338653',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector 5',
                'detalle' => 'Epson Power Lite x27 INV 338651',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector 6',
                'detalle' => 'Epson Power Lite x17 INV 316359',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector 7',
                'detalle' => 'Epson Power Lite x17 INV 316360',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector 8',
                'detalle' => 'Epson Power Lite x17 INV 319786',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector 9',
                'detalle' => 'Epson Power Lite x17 INV 319787',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector M1',
                'detalle' => 'Epson Power Lite x24 INV 326276',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector M2',
                'detalle' => 'Epson Power Lite x24 INV 326277',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector M3',
                'detalle' => 'Epson Power Lite x27 INV 341032',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Proyector M4',
                'detalle' => 'Epson Power Lite x27 INV 341029',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook M1',
                'detalle' => 'Lenovo B50-70 INV 330188',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook 2',
                'detalle' => 'Lenovo Idea S145 INV 351706',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook 3',
                'detalle' => 'Samsung I3 1315U INV 363115',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook B',
                'detalle' => 'HP Probook 450 gb s/n INV 330188',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook C',
                'detalle' => 'Samsung I3 1315U INV 363114',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook Sala de profesores',
                'detalle' => 'Dell Inspiron INV 363117',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook D',
                'detalle' => 'Samsung NP750XFG INV 363113',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook 4',
                'detalle' => 'Asus X515EA INV 359742',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook 5',
                'detalle' => 'Asus X515EA INV 359743',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook 7',
                'detalle' => 'Toshiba Satellite L845 INV 316363',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook 8',
                'detalle' => 'Asus X515EA INV 359744',
                'cantidad' => '1'
            ]
        );
        Equipment::create(
            [
                'name' => 'Notebook 9',
                'detalle' => 'Lenovo B50-70 INV 319782',
                'cantidad' => '1'
            ]
        );
    }
}
