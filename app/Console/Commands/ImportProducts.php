<?php

namespace App\Console\Commands;

use App\Models\Categories;
use App\Models\Products;
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


    public function __getCatsApiCode(){
        $catController=new \App\Http\Controllers\CategoriesController;
        $perCodes=$catController->__getCats('');
        $secCodes=[];
        foreach ($perCodes as $item){
            $secCodes[]=$catController->__getCats($item->Api_value);
        }
        $chillCodes=[];
        foreach ($secCodes as $items){
            foreach ($items as $itm) {
                $chillCodes[]=$catController->__getCats($itm->Api_value);
            }
        }
        return ['perCodes'=>$perCodes,
                'secCodes'=>$secCodes,
                'chillCodes'=>$chillCodes
        ];
    }

    private function __callApi($apiCodes){
        $page_size='20';
        $headers = [
            'X-Rapidapi-Key' => '532d9547bfmsh5628301a30a1296p1a5667jsne5fb9db39543',
            'X-Rapidapi-Host' => 'apidojo-hm-hennes-mauritz-v1.p.rapidapi.com',
        ];
        foreach ($apiCodes as $apiCode) {
            // Xử lý từng Api_code tại đây
            if(!isset($apiCode->Api_code)){
                $this->info('hadt code');
                continue;
            }
            $url = 'https://apidojo-hm-hennes-mauritz-v1.p.rapidapi.com/products/list?country=us&lang=en&currentpage=0&pagesize='.$page_size.'&categories='.$apiCode->Api_code.'';

            // Thực hiện yêu cầu GET
            $response = Http::withHeaders($headers)->retry(3, 3000)->get($url);
            // Xử lý dữ liệu trong response
            if ($response->successful()) {
                $data = $response->json();
                $this->__checkApiData($data,$apiCode->Cid);
                // Xử lý dữ liệu ở đây
                $this->info('successfully.');
            } else {
                // Xử lý trường hợp lỗi
                $this->error('Failed to import products.');
            }
        }
    }
    private function __getDetail($apiCode){

        $url = 'https://apidojo-hm-hennes-mauritz-v1.p.rapidapi.com/products/detail';

        // Các tham số truy vấn
        $queryParameters = [
            'lang' => 'en',
            'country' => 'us',
            'productcode' => $apiCode
        ];


        $headers = [
            'X-Rapidapi-Key' => 'c86d0aa1ecmsh1c4262d1e722aacp1622aejsnfc0f67fc57fb',
            'X-Rapidapi-Host' => 'apidojo-hm-hennes-mauritz-v1.p.rapidapi.com',
        ];

            // Thực hiện yêu cầu GET
        $response = Http::withHeaders($headers)->retry(3, 3000)->get($url, $queryParameters);
        // Xử lý dữ liệu trong response
        if ($response->successful()) {
            // Xử lý dữ liệu ở đây
            return $response->json()['product']['description'];
        } else {
            // Xử lý trường hợp lỗi
            return '';
        }
    }


    private function __checkApiData($datas,$Cid){
        foreach($datas['results'] as $data){
            $color_name='';
            foreach($data['articleColorNames']as $color){
                $color_name .= $color.'|end|';
            }
            $url_Images='';
            foreach($data['galleryImages']as $img){
                $url_Images .= $img['url'].'|end|';
            }
            $sizes='';
            foreach($data['variantSizes']as $size){
                $sizes .= $size['filterCode'].'|end|';
            }
            $apicode=$data['articles'][0]['code'];
            $existingProduct = Products::where('Api_code',$apicode)->first();
            if($existingProduct){
                continue;
            }
            $product=['Cid'=>$Cid,
                      'Product_name'=>$data['name'],
                      'Main_image'=>$data['images'][0]['url'],
                      'Price'=>$data['price']['value'],
                      'Images'=>$url_Images,
                      'Colors'=>$color_name,
                      'Sizes'=>$sizes,
                      'Description'=>$this->__getDetail($apicode),
                      'Quantit_in_stock'=>rand(0, 100),
                      'Api_code'=>$apicode
                    ];
            Products::create($product);
        }
    }

    private function __checkNewApiData($datas,$Cid){
        $tempProd=[];
        $tempPid=0;
        foreach($datas['results'] as $data){
            $color_name='';
            foreach($data['articleColorNames']as $color){
                $color_name .= $color.'|end|';
            }
            $url_Images='';
            foreach($data['galleryImages']as $img){
                $url_Images .= $img['url'].'|end|';
            }
            $sizes='';
            foreach($data['variantSizes']as $size){
                $sizes .= $size['filterCode'].'|end|';
            }
            $apicode=$data['articles'][0]['code'];
            $existingProduct = Products::where('Api_code',$apicode)->first();
            if($existingProduct){
                continue;
            }
            $product=[
                      'tempPid'=>$tempPid,
                      'Cid'=>$Cid,
                      'Product_name'=>$data['name'],
                      'Main_image'=>$data['images'][0]['url'],
                      'Price'=>$data['price']['value'],
                      'Images'=>$url_Images,
                      'Colors'=>$color_name,
                      'Sizes'=>$sizes,
                      'Description'=>$this->__getDetail($apicode),
                      'Quantit_in_stock'=>rand(0, 100),
                      'Api_code'=>$apicode
                    ];
            array_push($tempProd,$product);
            $tempPid++;
        }
        return $tempProd;
    }

    public function getNewProduct($value){
        $catController=new \App\Http\Controllers\CategoriesController();
        $cat=$catController->getCatById($value);
        $page_size='12';
        $headers = [
            'X-Rapidapi-Key' => '532d9547bfmsh5628301a30a1296p1a5667jsne5fb9db39543',
            'X-Rapidapi-Host' => 'apidojo-hm-hennes-mauritz-v1.p.rapidapi.com',
        ];
        $url = 'https://apidojo-hm-hennes-mauritz-v1.p.rapidapi.com/products/list?country=us&lang=en&currentpage=0&pagesize='.$page_size.'&categories='.$cat->Api_code.'';

        // Thực hiện yêu cầu GET
        $response = Http::withHeaders($headers)->retry(3, 3000)->get($url);
        // Xử lý dữ liệu trong response
        if ($response->successful()) {
            $data = $response->json();
            return $this->__checkNewApiData($data,$value);
        } else {
            // Xử lý trường hợp lỗi
            return [];
        }
    }

    public function handle()
    {
        $getCode=$this->__getCatsApiCode();
        // foreach($getCode['chillCodes'] as $chil){
        //     $this->__callApi($chil);
        // }
        $this->__callApi($getCode['perCodes']);
    }
}
