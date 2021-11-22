<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderKey;
use Cartalyst\Stripe\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Exception\UnauthorizedException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('shop.checkout')->with('products', $products);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'location' => ['required', 'string'],
            'card_number' => ['required', 'numeric'],
            'exp_month' => ['required', 'numeric'],
            'exp_year' => ['required', 'numeric'],
            'cvc' => ['required', 'numeric'],
            'location' => ['required', 'string'],
        ]);

        $stripe = Stripe::make(env('STRIPE_KEY'));

        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();

        try {

            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc
                ]
            ]);

            $customer = $stripe->customers()->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'source' => $token['id'],
            ]);

            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => 'KES',
                'amount' => Cart::subTotal(),
                'description' => 'Order',
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                ],
            ]);

            //store cart
            //Cart::instance('default')->store(auth()->user()->id);
            OrderKey::create([
                'order_key' => $charge['id'],
                'status' => 'Pending',
            ]);

            // Insert into order_product table
            foreach (Cart::content() as $item) {
                $order = Order::create([
                    'order' => $charge['id'],
                    'product_slug' => $item->model->slug,
                    'product_name' => $item->model->name,
                    'quantity' => $item->qty,
                    'price' => $item->model->price,
                    'total' => $item->model->price * $item->qty,
                ]);

                $order->customers()->sync(auth()->user()->id);
            }

            Cart::instance('default')->destroy();

            return redirect()->route('urban.payment.confirmation');
        } catch (UnauthorizedException $e) {
            // Get the status code
            $code = $e->getCode();

            // Get the error message returned by Stripe
            $message = $e->getMessage();

            // Get the error type returned by Stripe
            $type = $e->getErrorType();
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
