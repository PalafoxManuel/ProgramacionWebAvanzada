<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludoVista/{nombre}', function ($nombre) {
    return view('saludo', ['nombre' => $nombre]);
})->where('nombre', '[a-zA-Z]+');

Route::get('/saludo/{nombre}/{apellido?}', function ($nombre, $apellido = null) {
    $apellido = $apellido ? $apellido : '';
    return "Hola, {$nombre} {$apellido}!";
})->where(['nombre' => '[a-zA-Z]+', 'apellido' => '[a-zA-Z]+']);

Route::get('/operacion/{tipo}/{n1}/{n2}', function ($tipo, $n1, $n2) {

    switch ($tipo) {
        case 'suma':
            $resultado = $n1 + $n2;
            break;
        case 'resta':
            $resultado = $n1 - $n2;
            break;
        case 'multiplicacion':
            $resultado = $n1 * $n2;
            break;
        case 'division':
            if ($n2 == 0) {
                return "Error: No se puede dividir por cero.";
            }
            $resultado = $n1 / $n2;
            break;
        default:
            return "Operación no válida. Las operaciones válidas son: suma, resta, multiplicacion, division.";
    }

    return "Resultado: " . $resultado;
})->where([
    'tipo' => 'suma|resta|multiplicacion|division',
    'n1' => '[0-9]',
    'n2' => '[0-9]'
]);