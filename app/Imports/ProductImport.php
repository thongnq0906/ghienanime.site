<?php

namespace App\Imports;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Requests\ProductRequest;
use Image, File;

class ProductsImport implements ToCollection
{
    private $data;

    public function __construct ($data)
    {
        return $this->data = $data;
    }

    public function collection(Collection $rows)
    {
        $product_id = $this->data;
        // $input = $rows->toArray();
        // dd($input);
        // $rules = [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'message' => 'required|max:250',
        // ];
        // $customMessages = [
        //     'required' => 'The :attribute field is required.'
        // ];
        // Validator::make($input, $rules, $customMessages)->validate();

//        $input = $rows->toArray();
//        $rules = [
//            '*.1' => 'required',
//            '*.4' => 'required',
//            '*.6' => 'required',
//        ];
//        $customMessages = [
//            'required' => 'Dòng :attribute không được bỏ trống',
//        ];
//        Validator::make($input, $rules, $customMessages)->validate();

        foreach ($rows as $key => $row) {
            if ($key > 1) {
                $episode                  = new Images;
                $episode->ep = $row[0];
                $episode->link1 = $row[1];
                $episode->product_id = $product_id;
                $episode->slug            = 'tap-'.$row[0];

                $episode->save();
            }
        }
    }
}
