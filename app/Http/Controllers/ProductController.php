<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use File;

class ProductController extends Controller
{
    public function __construct()
    {
        
    }

    public function loadProducts(Request $request){
        $productList = array();
        $isSuccess = false;
        $message = "";
        try{
            $requestData = $request->all();
            $productList = Product::orderBy('created_at', 'ASC');
            if(isset($requestData["searchText"]) && !empty($requestData["searchText"]))
            {
                $productList = $productList->where("productName",'like','%' . $requestData["searchText"] . '%');
            }
            $productList = $productList->get();
            $sum = 0;
            $sumOfQuantity = 0;
            foreach($productList as $key => &$value){
                $amount = round($value["quantity"] * $value["pricePerUnit"],2);
                $productList[$key]["amount"] =$amount;
                $productList[$key]["SR"] =$key+1;
                $productList[$key]["date_added"] = date_format($value["created_at"],"Y/m/d H:i:s");;
                $sum = $sum + $amount;
                $sumOfQuantity = $sumOfQuantity + $value["quantity"];
            }
            $isSuccess = true;
            $message = "Products loaded successfully!";
        }
        catch(Excepetion $ex){
            $message = $ex->getMessage();
        }
        $response =  array(
            "success" => $isSuccess,
            "data" => array("productList"=>$productList,"sum"=>$sum,"sumOfQuantity"=>$sumOfQuantity),
            'message'=> $message,
        );
        //print_r($response);exit;
        return response()->json($response); 
    }

    public function saveProduct(Request $request){
        $isSuccess = false;
        $message = "";

        try{
            $validator = Validator::make($request->all(), [
                'productName' => 'required|string',
                'quantity' => 'required|numeric',
                'pricePerUnit' => 'required|numeric'
            ]);
            if ($validator->fails()) {
               $message = implode(" ",$validator->messages()->all());
            }else{
                $data = $request->all();
                if(isset($data["id"]) && !empty($data["id"])){
                    $Product = Product::find($data["id"]);
                }else{
                    $Product = new Product();
                }                
                $Product->productName = $data["productName"];
                $Product->quantity = $data["quantity"];
                $Product->pricePerUnit = $data["pricePerUnit"];
                $Product->save();

                $fileName = 'product_'.$Product->id.'.json';
                File::put(public_path('/json_files/'.$fileName),$Product);

                $Product->jsonFileName = $fileName;
                $Product->jsonFileNameURL = config('app.url') . "json_files/" .$fileName;
                $Product->save();
                
                $isSuccess = true;
                $message = "Product saved successfully!";
            }
        }
        catch(Excepetion $ex){
            $message = $ex->getMessage();
        }
        $response =  array(
            "success" => $isSuccess,
            'message'=> $message,
        );
        return response()->json($response); 
    }
}
