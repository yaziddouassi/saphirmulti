<?php

use Illuminate\Support\Facades\Route;

/*$directory = base_path('routes'); // Specify the directory
$fileName = 'saphir.php'; // Specify the file name

$filePath = $directory . DIRECTORY_SEPARATOR . $fileName;

if (file_exists($filePath)) {
    require_once $filePath;
} */


Route::middleware('web')->group(function () {
   
   $temp = config('saphir.middlewareDev');
    Route::get('/saphir/crud-generator',\Saphir\Multi\Livewire\Saphir1::class)->middleware($temp);
    Route::get('/saphir/chart-generator', \Saphir\Multi\Livewire\Saphir2::class)->middleware($temp);
    Route::get('/saphir/wizard-generator', \Saphir\Multi\Livewire\Saphir3::class)->middleware($temp);
    Route::get('/saphir/route-generator', \Saphir\Multi\Livewire\Saphir4::class)->middleware($temp);
    Route::get('/saphir/widget-generator', \Saphir\Multi\Livewire\Saphir5::class)->middleware($temp);
    Route::get('/saphir/route-generator/create', \Saphir\Multi\Livewire\Saphir6::class)->middleware($temp);
    Route::get('/saphir/route-generator/edit/{id}', \Saphir\Multi\Livewire\Saphir7::class)->middleware($temp);
    Route::get('/saphir/login', \Saphir\Multi\Livewire\Saphir8::class);
});
