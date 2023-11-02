<?php

namespace App\Console\Commands;

use App\Models\Categories;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportProducts extends Command
{
    protected $signature = 'import:products';

    protected $description = 'Import products from an external API';

    public function __construct()
    {
        parent::__construct();
    }

    public function __checkApiCode(){

    }

    public function handle()
    {
        $page_size='2';
        $apiCodes = Categories::pluck('Api_code');

        foreach ($apiCodes as $apiCode) {
            // Xử lý từng Api_code tại đây
            $this->info('Api_code: ' . $apiCode);

            $url = 'https://apidojo-hm-hennes-mauritz-v1.p.rapidapi.com/products/list?country=us&lang=en&currentpage=0&pagesize='.$page_size.'&categories='.$apiCode.'&concepts=H%26M%20MAN';
        }
        // Thêm các tiêu đề cần thiết
        $headers = [
            'X-Rapidapi-Key' => '9b61b4e946msh46411aec102e2e0p1811f6jsnae1b7ff728c7',
            'X-Rapidapi-Host' => 'apidojo-hm-hennes-mauritz-v1.p.rapidapi.com',
        ];

        // Thực hiện yêu cầu GET
        $response = Http::withHeaders($headers)->get($url);

        // Xử lý dữ liệu trong response
        if ($response->successful()) {
            $data = $response->json();
            // Xử lý dữ liệu ở đây
            $this->info('Products imported successfully.');
        } else {
            // Xử lý trường hợp lỗi
            $this->error('Failed to import products.');
        }
    }
}
