<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importa el facade DB

class UnidadAcademicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usamos DB::table para inserción masiva
        DB::table('UnidadAcademica')->insert([
            // Nivel Medio Superior
            ['idUnidadAcademica' => 'CECyT1', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 1 “Gonzalo Vázquez Vela”', 'siglas' => 'CECyT 1', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT2', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 2 “Miguel Bernard Perales”', 'siglas' => 'CECyT 2', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT3', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 3 “Estanislao Ramírez Ruiz”', 'siglas' => 'CECyT 3', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT4', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 4 “Lázaro Cárdenas”', 'siglas' => 'CECyT 4', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT5', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 5 “Benito Juárez García”', 'siglas' => 'CECyT 5', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT6', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 6 “Miguel Othón de Mendizábal”', 'siglas' => 'CECyT 6', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT7', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 7 “Cuauhtémoc”', 'siglas' => 'CECyT 7', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT8', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 8 “Narciso Bassols García”', 'siglas' => 'CECyT 8', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT9', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 9 “Juan de Dios Bátiz Paredes”', 'siglas' => 'CECyT 9', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT10', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 10 “Carlos Vallejo Márquez”', 'siglas' => 'CECyT 10', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT11', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 11 “Wilfrido Massieu”', 'siglas' => 'CECyT 11', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT12', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 12 “José María Morelos y Pavón”', 'siglas' => 'CECyT 12', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT13', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 13 “Ricardo Flores Magón”', 'siglas' => 'CECyT 13', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT14', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 14 “Luis Enrique Erro Soler”', 'siglas' => 'CECyT 14', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT15', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 15 “Diódoro Antúnez Echegaray”', 'siglas' => 'CECyT 15', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT16', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 16 “Hidalgo”', 'siglas' => 'CECyT 16', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT17', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 17 “Guanajuato”', 'siglas' => 'CECyT 17', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT18', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 18 “Zacatecas”', 'siglas' => 'CECyT 18', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT19', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 19 “Leona Vicario, Tecámac”', 'siglas' => 'CECyT 19', 'fotografia' => null],
            ['idUnidadAcademica' => 'CECyT20', 'nombre' => 'Centro de Estudios Científicos y Tecnológicos n.º 20 “Natalia Serdán Alatriste, Puebla”', 'siglas' => 'CECyT 20', 'fotografia' => null],
            ['idUnidadAcademica' => 'CET1', 'nombre' => 'Centro de Estudios Tecnológicos n.º 1 “Walter Cross Buchanan”', 'siglas' => 'CET 1', 'fotografia' => null],
            // Nivel Superior
            ['idUnidadAcademica' => 'CICSUST', 'nombre' => 'Centro Interdisciplinario de Ciencias de la Salud Unidad Santo Tomás', 'siglas' => 'CICS UST', 'fotografia' => null],
            ['idUnidadAcademica' => 'CICSUMA', 'nombre' => 'Centro Interdisciplinario de Ciencias de la Salud Unidad Milpa Alta', 'siglas' => 'CICS UMA', 'fotografia' => null],
            ['idUnidadAcademica' => 'ENBA', 'nombre' => 'Escuela Nacional de Biblioteconomía y Archivonomía', 'siglas' => 'ENBA', 'fotografia' => null],
            ['idUnidadAcademica' => 'ENCB', 'nombre' => 'Escuela Nacional de Ciencias Biológicas', 'siglas' => 'ENCB', 'fotografia' => null],
            ['idUnidadAcademica' => 'ENMH', 'nombre' => 'Escuela Nacional de Medicina y Homeopatía', 'siglas' => 'ENMH', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESM', 'nombre' => 'Escuela Superior de Medicina', 'siglas' => 'ESM', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESEO', 'nombre' => 'Escuela Superior de Enfermería y Obstetricia', 'siglas' => 'ESEO', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESCA', 'nombre' => 'Escuela Superior de Comercio y Administración', 'siglas' => 'ESCA', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESE', 'nombre' => 'Escuela Superior de Economía', 'siglas' => 'ESE', 'fotografia' => null],
            ['idUnidadAcademica' => 'EST', 'nombre' => 'Escuela Superior de Turismo', 'siglas' => 'EST', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESIME', 'nombre' => 'Escuela Superior de Ingeniería Mecánica y Eléctrica', 'siglas' => 'ESIME', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESIA', 'nombre' => 'Escuela Superior de Ingeniería y Arquitectura', 'siglas' => 'ESIA', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESIQUE', 'nombre' => 'Escuela Superior de Ingeniería Química e Industrias Extractivas', 'siglas' => 'ESIQUE', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESIT', 'nombre' => 'Escuela Superior de Ingeniería Textil', 'siglas' => 'ESIT', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESFM', 'nombre' => 'Escuela Superior de Física y Matemáticas', 'siglas' => 'ESFM', 'fotografia' => null],
            ['idUnidadAcademica' => 'ESCOM', 'nombre' => 'Escuela Superior de Cómputo', 'siglas' => 'ESCOM', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIITA', 'nombre' => 'Unidad Profesional Interdisciplinaria en Ingeniería y Tecnologías Avanzadas', 'siglas' => 'UPIITA', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIICSA', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería y Ciencias Sociales y Administrativas', 'siglas' => 'UPIICSA', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIEM', 'nombre' => 'Unidad Profesional Interdisciplinaria de Energía y Movilidad', 'siglas' => 'UPIEM', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIBI', 'nombre' => 'Unidad Profesional Interdisciplinaria de Biotecnología', 'siglas' => 'UPIBI', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPICoah', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería Campus Coahuila', 'siglas' => 'UPICoah', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIGto', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería Campus Guanajuato', 'siglas' => 'UPIGto', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIHgo', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería Campus Hidalgo', 'siglas' => 'UPIHgo', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIPal', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería Campus Palenque', 'siglas' => 'UPIPal', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPIZac', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería Campus Zacatecas', 'siglas' => 'UPIZac', 'fotografia' => null],
            ['idUnidadAcademica' => 'UPITlx', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería Campus Tlaxcala', 'siglas' => 'UPITlx', 'fotografia' => null],
             ['idUnidadAcademica' => 'UPIIAP', 'nombre' => 'Unidad Profesional Interdisciplinaria de Ingeniería Alejo Peralta', 'siglas' => 'UPIIAP', 'fotografia' => null],

        ]);
    }
}
