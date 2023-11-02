<?php

namespace App\Console\Commands;

use App\Models\Categories;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportCategories extends Command
{
    protected $signature = 'import:categories';
    protected $description = 'Import categories from API';

    public function __construct()
    {
        parent::__construct();
    }

    // Kiểm tra data có các trường cần thiết để sử dụng hay không và thêm vào database nếu hợp lệ.
    public function __checkArray($subCatArray,$paValue){
        if($paValue!=''){
            $paValue=$paValue.'_';
        }
        foreach ($subCatArray as $category) {
            if(empty($category['tagCodes'])){
                $code='';
            }else{
                $code=$category['tagCodes'][0];
            }
            $value=$paValue.$category['CategoryValue'];
            $existingCategory = Categories::where('Api_value',$value)->first();
            if ($existingCategory) {
                continue;
            }
            $categoryData = [
                'Categories_name' => $category['CatName'],
                'Api_value' =>  $value,
                'Api_code' => $code
                // Các trường khác bạn muốn nhập vào cơ sở dữ liệu
            ];
            Categories::create($categoryData);
            if(!isset($category['CategoriesArray'])){
                continue;
            }
            $this->__checkArray($category['CategoriesArray'],$value);
        }
    }



    public function handle()
    {
        // Lấy dữ liệu từ API
        $url = 'https://apidojo-hm-hennes-mauritz-v1.p.rapidapi.com/categories/list';
        $queryParameters = [
            'lang' => 'en',
            'country' => 'us',
        ];

        $headers = [
            'X-Rapidapi-Key' => '9b61b4e946msh46411aec102e2e0p1811f6jsnae1b7ff728c7',
            'X-Rapidapi-Host' => 'apidojo-hm-hennes-mauritz-v1.p.rapidapi.com',
        ];

        $response = Http::withHeaders($headers)->get($url, $queryParameters);

        if ($response->successful()) {
            $data = $response->json();
            $this->__checkArray($data,'');
            // Sau khi xử lý, bạn có thể lưu dữ liệu vào cơ sở dữ liệu như đã mô tả trong các câu trả lời trước.
        } else {
            echo $response->status();
        }
        $this->info('Categories imported successfully.');
    }

}
