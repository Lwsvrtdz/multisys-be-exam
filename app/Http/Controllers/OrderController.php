<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $user = Auth::user();

        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json( //product not exists
                [
                    'message' => 'No product found'
                ], 404
            );
        }
        if ($product->available_stock >= $request->quantity) { //check quantity -> save then deduct
            $user->orders()->create(
                [
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]
            );
            $product->available_stock = $product->available_stock - $request->quantity;
            $product->save();
            return response()->json(
                [
                    'message' => "You have successfully ordered this product."
                ], 201
            );
        } else {
            return response()->json(
                [
                    'message' => "Failed to order this product due to unavailability of the stock"
                ], 400
            );
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
