<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ApiRequestConrtoller extends Controller
{
    public function singleProduct($slug){
        $product = Product::where('slug',$slug)->first();
        $data = [
            "id" => 1,
            "title" => "trim dress",
            "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
            "type" => "Shariful",
            "brand" => "nike",
            "collection" => ["new products"],
            "category" => "Woman",
            "price" => 145,
            "sale" => true,
            "discount" => "40",
            "stock" => 5,
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
            "variants" => [
                [
                    "variant_id" => 101,
                    "id" => 1,
                    "sku" => "sku1",
                    "size" => "s",
                    "color" => "yellow",
                    "image_id" => 111,
                    "price"  => 120
                ],
                [
                    "variant_id" => 102,
                    "id" => 1,
                    "sku" => "sku2",
                    "size" => "s",
                    "color" => "white",
                    "image_id" => 112,
                    "price"  => 150
                ],
                [
                    "variant_id" => 103,
                    "id" => 1,
                    "sku" => "sku3",
                    "size" => "s",
                    "color" => "pink",
                    "image_id" => 113,
                    "price"  => 100
                ],
                [
                    "variant_id" => 104,
                    "id" => 1,
                    "sku" => "sku4",
                    "size" => "m",
                    "color" => "yellow",
                    "image_id" => 111,
                    "price"  => 120
                ],
                [
                    "variant_id" => 105,
                    "id" => 1,
                    "sku" => "sku5",
                    "size" => "m",
                    "color" => "white",
                    "image_id" => 112,
                    "price"  => 150
                ],
                [
                    "variant_id" => 106,
                    "id" => 1,
                    "sku" => "sku5",
                    "size" => "m",
                    "color" => "pink",
                    "image_id" => 113,
                    "price"  => 100
                ],
                [
                    "variant_id" => 107,
                    "id" => 1,
                    "sku" => "sku1",
                    "size" => "l",
                    "color" => "yellow",
                    "image_id" => 111,
                    "price"  => 120
                ]
            ],
            "images" => [
                [
                    "image_id" => 111,
                    "id" => 1,
                    "alt" => "yellow",
                    "src" => "1.jpg",
                    "variant_id" => [
                        101,
                        104
                    ]
                ],
                [
                    "image_id" => 112,
                    "id" => 1,
                    "alt" => "white",
                    "src" => "2.jpg",
                    "variant_id" => [
                        102,
                        105
                    ]
                ],
                [
                    "image_id" => 113,
                    "id" => 1,
                    "alt" => "pink",
                    "src" => "3.jpg",
                    "variant_id" => [
                        103,
                        106
                    ]
                ]
            ]
                    ];
        return response()->json($data);
    }
    public function products(){
        $data = [
            [
                "id" => 1,
                "title" => "trim dress One",
                "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
                "type" => "Man",
                "brand" => "nike",
                "collection" => ["new products"],
                "category" => "Woman",
                "price" => 145,
                "sale" => true,
                "discount" => "40",
                "stock" => 5,
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
                "variants" => [
                    [
                        "variant_id" => 101,
                        "id" => 1,
                        "sku" => "sku1",
                        "size" => "s",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ],
                    [
                        "variant_id" => 102,
                        "id" => 1,
                        "sku" => "sku2",
                        "size" => "s",
                        "color" => "white",
                        "image_id" => 112,
                        "price"  => 150
                    ],
                    [
                        "variant_id" => 103,
                        "id" => 1,
                        "sku" => "sku3",
                        "size" => "s",
                        "color" => "pink",
                        "image_id" => 113,
                        "price"  => 100
                    ],
                    [
                        "variant_id" => 104,
                        "id" => 1,
                        "sku" => "sku4",
                        "size" => "m",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ],
                    [
                        "variant_id" => 105,
                        "id" => 1,
                        "sku" => "sku5",
                        "size" => "m",
                        "color" => "white",
                        "image_id" => 112,
                        "price"  => 150
                    ],
                    [
                        "variant_id" => 106,
                        "id" => 1,
                        "sku" => "sku5",
                        "size" => "m",
                        "color" => "pink",
                        "image_id" => 113,
                        "price"  => 100
                    ],
                    [
                        "variant_id" => 107,
                        "id" => 1,
                        "sku" => "sku1",
                        "size" => "l",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ]
                ],
                "images" => [
                    [
                        "image_id" => 111,
                        "id" => 1,
                        "alt" => "yellow",
                        "src" => "1.jpg",
                        "variant_id" => [
                            101,
                            104
                        ]
                    ],
                    [
                        "image_id" => 112,
                        "id" => 1,
                        "alt" => "white",
                        "src" => "2.jpg",
                        "variant_id" => [
                            102,
                            105
                        ]
                    ],
                    [
                        "image_id" => 113,
                        "id" => 1,
                        "alt" => "pink",
                        "src" => "3.jpg",
                        "variant_id" => [
                            103,
                            106
                        ]
                    ]
                ]
            ],
            [
                "id" => 2,
                "title" => "trim dress Two",
                "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
                "type" => "Man",
                "brand" => "nike",
                "collection" => ["new products"],
                "category" => "Woman",
                "price" => 145,
                "sale" => true,
                "discount" => "40",
                "stock" => 5,
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
                "variants" => [
                    [
                        "variant_id" => 101,
                        "id" => 1,
                        "sku" => "sku1",
                        "size" => "s",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ],
                    [
                        "variant_id" => 102,
                        "id" => 1,
                        "sku" => "sku2",
                        "size" => "s",
                        "color" => "white",
                        "image_id" => 112,
                        "price"  => 150
                    ],
                    [
                        "variant_id" => 103,
                        "id" => 1,
                        "sku" => "sku3",
                        "size" => "s",
                        "color" => "pink",
                        "image_id" => 113,
                        "price"  => 100
                    ],
                    [
                        "variant_id" => 104,
                        "id" => 1,
                        "sku" => "sku4",
                        "size" => "m",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ],
                    [
                        "variant_id" => 105,
                        "id" => 1,
                        "sku" => "sku5",
                        "size" => "m",
                        "color" => "white",
                        "image_id" => 112,
                        "price"  => 150
                    ],
                    [
                        "variant_id" => 106,
                        "id" => 1,
                        "sku" => "sku5",
                        "size" => "m",
                        "color" => "pink",
                        "image_id" => 113,
                        "price"  => 100
                    ],
                    [
                        "variant_id" => 107,
                        "id" => 1,
                        "sku" => "sku1",
                        "size" => "l",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ]
                ],
                "images" => [
                    [
                        "image_id" => 111,
                        "id" => 1,
                        "alt" => "yellow",
                        "src" => "1.jpg",
                        "variant_id" => [
                            101,
                            104
                        ]
                    ],
                    [
                        "image_id" => 112,
                        "id" => 1,
                        "alt" => "white",
                        "src" => "2.jpg",
                        "variant_id" => [
                            102,
                            105
                        ]
                    ],
                    [
                        "image_id" => 113,
                        "id" => 1,
                        "alt" => "pink",
                        "src" => "3.jpg",
                        "variant_id" => [
                            103,
                            106
                        ]
                    ]
                ]
            ],
            [
                "id" => 3,
                "title" => "trim dress Three",
                "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.",
                "type" => "Woman",
                "brand" => "nike",
                "collection" => ["new products"],
                "category" => "Woman",
                "price" => 145,
                "sale" => true,
                "discount" => "40",
                "stock" => 5,
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
                "variants" => [
                    [
                        "variant_id" => 101,
                        "id" => 1,
                        "sku" => "sku1",
                        "size" => "s",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ],
                    [
                        "variant_id" => 102,
                        "id" => 1,
                        "sku" => "sku2",
                        "size" => "s",
                        "color" => "white",
                        "image_id" => 112,
                        "price"  => 150
                    ],
                    [
                        "variant_id" => 103,
                        "id" => 1,
                        "sku" => "sku3",
                        "size" => "s",
                        "color" => "pink",
                        "image_id" => 113,
                        "price"  => 100
                    ],
                    [
                        "variant_id" => 104,
                        "id" => 1,
                        "sku" => "sku4",
                        "size" => "m",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ],
                    [
                        "variant_id" => 105,
                        "id" => 1,
                        "sku" => "sku5",
                        "size" => "m",
                        "color" => "white",
                        "image_id" => 112,
                        "price"  => 150
                    ],
                    [
                        "variant_id" => 106,
                        "id" => 1,
                        "sku" => "sku5",
                        "size" => "m",
                        "color" => "pink",
                        "image_id" => 113,
                        "price"  => 100
                    ],
                    [
                        "variant_id" => 107,
                        "id" => 1,
                        "sku" => "sku1",
                        "size" => "l",
                        "color" => "yellow",
                        "image_id" => 111,
                        "price"  => 120
                    ]
                ],
                "images" => [
                    [
                        "image_id" => 111,
                        "id" => 1,
                        "alt" => "yellow",
                        "src" => "1.jpg",
                        "variant_id" => [
                            101,
                            104
                        ]
                    ],
                    [
                        "image_id" => 112,
                        "id" => 1,
                        "alt" => "white",
                        "src" => "2.jpg",
                        "variant_id" => [
                            102,
                            105
                        ]
                    ],
                    [
                        "image_id" => 113,
                        "id" => 1,
                        "alt" => "pink",
                        "src" => "3.jpg",
                        "variant_id" => [
                            103,
                            106
                        ]
                    ]
                ]
            ],
        ];
        return response()->json($data);
    }
}

