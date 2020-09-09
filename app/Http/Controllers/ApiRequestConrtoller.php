<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ApiRequestConrtoller extends Controller
{
    public function singleProduct($slug){
        $product = Product::where('id',$slug)->with(['category','inventory','itemimage'])->first();
        // dd($product);
        $data = [];
        $data = [
            "id" => $product->id,
            "title" => $product->name,
            "description" => $product->description,
            "type" => $product->category->name,
            "brand" => $product->brand_id,
            "collection" => [
                'New Products'
            ],
            "category" => $product->category->name,
            "price" => $product->price,
            "sale" => true,
            "discount" => 0,
            "stock" => 50,
            "new" => true,
            "tags" => [
                "new",
                "s",
                "m",
                "yellow",
                "white",
                "pink",
                "nike"
            ],
        ];
        foreach($product->inventory as $variants){
            $data['variants'][] = [
                "variant_id" => $variants->id,
                "id" => $variants->id,
                "sku" => $variants->seller_sku,
                "size" => 's',
                "color" => strtolower($variants->color_name),
                "image_id" => 111,
                "price"  => $variants->price,
            ];
        }
        foreach($product->itemimage as $img){
            $data['images'][$img->color_slug][] = [
                "image_id" => $img->id,
                "id" => $img->id,
                "alt" => $img->color_slug,
                "src" => asset($img->org_img),
            ];
        }
        // dd($data);
        return response()->json($data);
        // $data = [
        //     "id" => 1,
        //     "title" => "trim dress asdfasdfasdf",
        //     "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
        //     "type" => "Shariful",
        //     "brand" => "nike",
        //     "collection" => ["new products"],
        //     "category" => "Woman",
        //     "price" => 145,
        //     "sale" => true,
        //     "discount" => "40",
        //     "stock" => 5,
        //     "new" => true,
        //     "tags" => [
        //         "new",
        //         "s",
        //         "m",
        //         "yellow",
        //         "white",
        //         "pink",
        //         "nike"
        //     ],
        //     "variants" => [
        //         [
        //             "variant_id" => 101,
        //             "id" => 1,
        //             "sku" => "sku1",
        //             "size" => "s",
        //             "color" => "yellow",
        //             "image_id" => 111,
        //             "price"  => 120
        //         ],
        //         [
        //             "variant_id" => 102,
        //             "id" => 1,
        //             "sku" => "sku2",
        //             "size" => "s",
        //             "color" => "white",
        //             "image_id" => 112,
        //             "price"  => 150
        //         ],
        //         [
        //             "variant_id" => 103,
        //             "id" => 1,
        //             "sku" => "sku3",
        //             "size" => "s",
        //             "color" => "pink",
        //             "image_id" => 113,
        //             "price"  => 100
        //         ],
        //         [
        //             "variant_id" => 104,
        //             "id" => 1,
        //             "sku" => "sku4",
        //             "size" => "m",
        //             "color" => "yellow",
        //             "image_id" => 111,
        //             "price"  => 120
        //         ],
        //         [
        //             "variant_id" => 105,
        //             "id" => 1,
        //             "sku" => "sku5",
        //             "size" => "m",
        //             "color" => "white",
        //             "image_id" => 112,
        //             "price"  => 150
        //         ],
        //         [
        //             "variant_id" => 106,
        //             "id" => 1,
        //             "sku" => "sku5",
        //             "size" => "m",
        //             "color" => "pink",
        //             "image_id" => 113,
        //             "price"  => 100
        //         ],
        //         [
        //             "variant_id" => 107,
        //             "id" => 1,
        //             "sku" => "sku1",
        //             "size" => "l",
        //             "color" => "yellow",
        //             "image_id" => 111,
        //             "price"  => 120
        //         ]
        //     ],
        //     "images" => [
        //         'main' => [
        //             [
        //                 "image_id" => 111,
        //                 "id" => 1,
        //                 "alt" => "main",
        //                 "src" => "https://placebeard.it/470x650",
        //             ],
        //             [
        //                 "image_id" => 112,
        //                 "id" => 2,
        //                 "alt" => "main",
        //                 "src" => "https://placebeard.it/471x650",
        //             ],
        //             [
        //                 "image_id" => 113,
        //                 "id" => 3,
        //                 "alt" => "main",
        //                 "src" => "https://placebeard.it/472x650",
        //             ],
        //         ],
        //         'yellow' => [
        //             [
        //                 "image_id" => 111,
        //                 "id" => 1,
        //                 "alt" => "yellow",
        //                 "src" => "https://placebeard.it/475x651",
        //             ],
        //             [
        //                 "image_id" => 112,
        //                 "id" => 2,
        //                 "alt" => "yellow",
        //                 "src" => "https://placebeard.it/475x652",
        //             ],
        //             [
        //                 "image_id" => 113,
        //                 "id" => 3,
        //                 "alt" => "yellow",
        //                 "src" => "https://placebeard.it/475x653",
        //             ],
        //         ],
        //         'pink' => [
        //             [
        //                 "image_id" => 111,
        //                 "id" => 1,
        //                 "alt" => "pink",
        //                 "src" => "https://placebeard.it/475x654",
        //             ],
        //             [
        //                 "image_id" => 112,
        //                 "id" => 2,
        //                 "alt" => "pink",
        //                 "src" => "https://placebeard.it/472x651",
        //             ],
        //             [
        //                 "image_id" => 113,
        //                 "id" => 3,
        //                 "alt" => "pink",
        //                 "src" => "https://placebeard.it/473x650",
        //             ],
        //         ],
        //         'white' => [
        //             [
        //                 "image_id" => 111,
        //                 "id" => 1,
        //                 "alt" => "white",
        //                 "src" => "https://placebeard.it/470x650",
        //             ],
        //             [
        //                 "image_id" => 112,
        //                 "id" => 2,
        //                 "alt" => "white",
        //                 "src" => "https://placebeard.it/471x652",
        //             ],
        //             [
        //                 "image_id" => 113,
        //                 "id" => 3,
        //                 "alt" => "white",
        //                 "src" => "https://placebeard.it/469x651",
        //             ],
        //         ],
        //         ]
        // ];
            
        // print_r($product);
        
    }
    public function products(){
        $products = Product::with(['category','inventory','itemimage'])->where('id','>=',10)->get();
        // dd($products);
        $i = 0;
        foreach($products as $product){
            $data[$i] = [
                "id" => $product->id,
                "title" => $product->name,
                "description" => $product->description,
                "type" => $product->category->name,
                "brand" => $product->brand_id,
                "collection" => [
                    'New Products'
                ],
                "category" => $product->category->name,
                "price" => $product->price,
                "sale" => true,
                "discount" => 0,
                "stock" => 50,
                "new" => true,
                "tags" => [
                    "new",
                    "s",
                    "m",
                    "yellow",
                    "white",
                    "pink",
                    "nike"
                ],
            ];
            foreach($product->inventory as $variants){
                $data[$i]['variants'][] = [
                    "variant_id" => $variants->id,
                    "id" => $variants->id,
                    "sku" => $variants->seller_sku,
                    "size" => 's',
                    "color" => strtolower($variants->color_name),
                    "image_id" => 111,
                    "price"  => $variants->price,
                ];
            }
            foreach($product->itemimage as $img){
                $data[$i]['images'][$img->color_slug][] = [
                    "image_id" => $img->id,
                    "id" => $img->id,
                    "alt" => $img->color_slug,
                    "src" => asset($img->org_img),
                ];
            }
            $i++;
        }
        // dd($data);
        return response()->json($data);





        // $data = [
        //     [
        //         "id" => 1,
        //         "title" => "trim dress One",
        //         "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
        //         "type" => "Man",
        //         "brand" => "nike",
        //         "collection" => ["new products"],
        //         "category" => "Woman",
        //         "price" => 145,
        //         "sale" => true,
        //         "discount" => "40",
        //         "stock" => 5,
        //         "new" => true,
        //         "tags" => [
        //             "new",
        //             "s",
        //             "m",
        //             "yellow",
        //             "white",
        //             "pink",
        //             "nike"
        //         ],
        //         "variants" => [
        //             [
        //                 "variant_id" => 101,
        //                 "id" => 1,
        //                 "sku" => "sku1",
        //                 "size" => "s",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ],
        //             [
        //                 "variant_id" => 102,
        //                 "id" => 1,
        //                 "sku" => "sku2",
        //                 "size" => "s",
        //                 "color" => "white",
        //                 "image_id" => 112,
        //                 "price"  => 150
        //             ],
        //             [
        //                 "variant_id" => 103,
        //                 "id" => 1,
        //                 "sku" => "sku3",
        //                 "size" => "s",
        //                 "color" => "pink",
        //                 "image_id" => 113,
        //                 "price"  => 100
        //             ],
        //             [
        //                 "variant_id" => 104,
        //                 "id" => 1,
        //                 "sku" => "sku4",
        //                 "size" => "m",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ],
        //             [
        //                 "variant_id" => 105,
        //                 "id" => 1,
        //                 "sku" => "sku5",
        //                 "size" => "m",
        //                 "color" => "white",
        //                 "image_id" => 112,
        //                 "price"  => 150
        //             ],
        //             [
        //                 "variant_id" => 106,
        //                 "id" => 1,
        //                 "sku" => "sku5",
        //                 "size" => "m",
        //                 "color" => "pink",
        //                 "image_id" => 113,
        //                 "price"  => 100
        //             ],
        //             [
        //                 "variant_id" => 107,
        //                 "id" => 1,
        //                 "sku" => "sku1",
        //                 "size" => "l",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ]
        //         ],
        //         "images" => [
        //             'main' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/470x650",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/471x650",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/472x650",
        //                 ],
        //             ],
        //             'yellow' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x651",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x652",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x653",
        //                 ],
        //             ],
        //             'pink' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/475x654",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/472x651",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/473x650",
        //                 ],
        //             ],
        //             'white' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/470x650",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/471x652",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/469x651",
        //                 ],
        //             ],
        //         ]
        //     ],
        //     [
        //         "id" => 2,
        //         "title" => "trim dress Two",
        //         "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
        //         "type" => "Man",
        //         "brand" => "nike",
        //         "collection" => ["new products"],
        //         "category" => "Woman",
        //         "price" => 145,
        //         "sale" => true,
        //         "discount" => "40",
        //         "stock" => 5,
        //         "new" => true,
        //         "tags" => [
        //             "new",
        //             "s",
        //             "m",
        //             "yellow",
        //             "white",
        //             "pink",
        //             "nike"
        //         ],
        //         "variants" => [
        //             [
        //                 "variant_id" => 101,
        //                 "id" => 1,
        //                 "sku" => "sku1",
        //                 "size" => "s",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ],
        //             [
        //                 "variant_id" => 102,
        //                 "id" => 1,
        //                 "sku" => "sku2",
        //                 "size" => "s",
        //                 "color" => "white",
        //                 "image_id" => 112,
        //                 "price"  => 150
        //             ],
        //             [
        //                 "variant_id" => 103,
        //                 "id" => 1,
        //                 "sku" => "sku3",
        //                 "size" => "s",
        //                 "color" => "pink",
        //                 "image_id" => 113,
        //                 "price"  => 100
        //             ],
        //             [
        //                 "variant_id" => 104,
        //                 "id" => 1,
        //                 "sku" => "sku4",
        //                 "size" => "m",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ],
        //             [
        //                 "variant_id" => 105,
        //                 "id" => 1,
        //                 "sku" => "sku5",
        //                 "size" => "m",
        //                 "color" => "white",
        //                 "image_id" => 112,
        //                 "price"  => 150
        //             ],
        //             [
        //                 "variant_id" => 106,
        //                 "id" => 1,
        //                 "sku" => "sku5",
        //                 "size" => "m",
        //                 "color" => "pink",
        //                 "image_id" => 113,
        //                 "price"  => 100
        //             ],
        //             [
        //                 "variant_id" => 107,
        //                 "id" => 1,
        //                 "sku" => "sku1",
        //                 "size" => "l",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ]
        //         ],
        //         "images" => [
        //             'main' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/470x650",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/471x650",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/472x650",
        //                 ],
        //             ],
        //             'yellow' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x651",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x652",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x653",
        //                 ],
        //             ],
        //             'pink' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/475x654",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/472x651",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/473x650",
        //                 ],
        //             ],
        //             'white' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/470x650",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/471x652",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/469x651",
        //                 ],
        //             ],
        //         ]
        //     ],
        //     [
        //         "id" => 3,
        //         "title" => "trim dress Three",
        //         "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
        //         "type" => "Woman",
        //         "brand" => "nike",
        //         "collection" => ["new products"],
        //         "category" => "Woman",
        //         "price" => 145,
        //         "sale" => true,
        //         "discount" => "40",
        //         "stock" => 5,
        //         "new" => true,
        //         "tags" => [
        //             "new",
        //             "s",
        //             "m",
        //             "yellow",
        //             "white",
        //             "pink",
        //             "nike"
        //         ],
        //         "variants" => [
        //             [
        //                 "variant_id" => 101,
        //                 "id" => 1,
        //                 "sku" => "sku1",
        //                 "size" => "s",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ],
        //             [
        //                 "variant_id" => 102,
        //                 "id" => 1,
        //                 "sku" => "sku2",
        //                 "size" => "s",
        //                 "color" => "white",
        //                 "image_id" => 112,
        //                 "price"  => 150
        //             ],
        //             [
        //                 "variant_id" => 103,
        //                 "id" => 1,
        //                 "sku" => "sku3",
        //                 "size" => "s",
        //                 "color" => "pink",
        //                 "image_id" => 113,
        //                 "price"  => 100
        //             ],
        //             [
        //                 "variant_id" => 104,
        //                 "id" => 1,
        //                 "sku" => "sku4",
        //                 "size" => "m",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ],
        //             [
        //                 "variant_id" => 105,
        //                 "id" => 1,
        //                 "sku" => "sku5",
        //                 "size" => "m",
        //                 "color" => "white",
        //                 "image_id" => 112,
        //                 "price"  => 150
        //             ],
        //             [
        //                 "variant_id" => 106,
        //                 "id" => 1,
        //                 "sku" => "sku5",
        //                 "size" => "m",
        //                 "color" => "pink",
        //                 "image_id" => 113,
        //                 "price"  => 100
        //             ],
        //             [
        //                 "variant_id" => 107,
        //                 "id" => 1,
        //                 "sku" => "sku1",
        //                 "size" => "l",
        //                 "color" => "yellow",
        //                 "image_id" => 111,
        //                 "price"  => 120
        //             ]
        //         ],
        //         "images" => [
        //             'main' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/470x650",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/471x650",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "main",
        //                     "src" => "https://placebeard.it/472x650",
        //                 ],
        //             ],
        //             'yellow' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x651",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x652",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "yellow",
        //                     "src" => "https://placebeard.it/475x653",
        //                 ],
        //             ],
        //             'pink' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/475x654",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/472x651",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "pink",
        //                     "src" => "https://placebeard.it/473x650",
        //                 ],
        //             ],
        //             'white' => [
        //                 [
        //                     "image_id" => 111,
        //                     "id" => 1,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/470x650",
        //                 ],
        //                 [
        //                     "image_id" => 112,
        //                     "id" => 2,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/471x652",
        //                 ],
        //                 [
        //                     "image_id" => 113,
        //                     "id" => 3,
        //                     "alt" => "white",
        //                     "src" => "https://placebeard.it/469x651",
        //                 ],
        //             ],
        //         ]
        //     ],
        // ];
        
    }
}

