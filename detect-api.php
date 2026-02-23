<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;

$key = "3TSzyooT121112ec13d9ad2d7UOjvVRs";

echo "--- MENGUJI PROVIDER API ---
";

// 1. Uji BinderByte
$res1 = Http::get("https://api.binderbyte.com/v1/cost", [
    'api_key' => $key,
    'courier' => 'jne',
    'origin' => 'JAKARTA',
    'destination' => 'BANDUNG',
    'weight' => 1
]);
echo "BinderByte: " . ($res1->successful() ? "BERHASIL" : "GAGAL (".$res1->status().": ".$res1->body().")") . "
";

// 2. Uji RajaOngkir
$res2 = Http::withHeaders(['key' => $key])->get("https://api.rajaongkir.com/starter/city");
echo "RajaOngkir: " . ($res2->successful() ? "BERHASIL" : "GAGAL (".$res2->status().")") . "
";

// 3. Uji Biteship
$res3 = Http::withHeaders(['Authorization' => 'Bearer ' . $key])->get("https://api.biteship.com/v1/couriers");
echo "Biteship: " . ($res3->successful() ? "BERHASIL" : "GAGAL (".$res3->status().")") . "
";
