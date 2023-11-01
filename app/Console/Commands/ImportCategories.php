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
    public function __checkArray($subCatArray,$paCode,$count){
        $freCode='';
        if($paCode!=''){
            $freCode=$paCode.'_';
        }
        $subcheck=$count;
        foreach ($subCatArray as $category) {
            if(empty($category['tagCodes'])){
                $categoryData = [
                    'Categories_name' => $category['CatName'],
                    'Api_value' => $category['CategoryValue'],
                    'Api_code'=> $freCode.$category['CategoryValue'].'_'.$count
                ];
                $existingCategory = Categories::where('Api_code', $categoryData['Api_code'])->first();
                if (!$existingCategory) {
                    // 'Api_code' chưa tồn tại trong cơ sở dữ liệu, tiến hành thêm mới
                    Categories::create($categoryData);
                }
                if(!isset($category['CategoriesArray'])){
                    break;
                }
                $this->__checkArray($category['CategoriesArray'],$category['CategoryValue'],++$count);
                break;
            }
            $categoryData = [
                'Categories_name' => $category['CatName'],
                'Api_value' => $category['CategoryValue'],
                'Api_code' => $freCode.$category['CategoryValue'].'_'. $count . '_' . $category['tagCodes'][0]
                // Các trường khác bạn muốn nhập vào cơ sở dữ liệu
            ];
            $existingCategory = Categories::where('Api_code', $categoryData['Api_code'])->first();
            if (!$existingCategory) {
                // 'Api_code' chưa tồn tại trong cơ sở dữ liệu, tiến hành thêm mới
                Categories::create($categoryData);
            }
            if(!isset($category['CategoriesArray'])){
                break;
            }
            $this->__checkArray($category['CategoriesArray'],$category['CategoryValue'],$count);

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
            $this->__checkArray($data,'',0);
            // Sau khi xử lý, bạn có thể lưu dữ liệu vào cơ sở dữ liệu như đã mô tả trong các câu trả lời trước.
        } else {
            echo $response->status();
        }
        $this->info('Categories imported successfully.');
    }

}
