<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PizzaController extends Controller
{
    public function showOrderForm()
    {
        return view('order');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'size' => 'required|in:small,medium,large',
        ]);
    
        $size = $request->input('size');
        $addPepperoni = $request->input('pepperoni', false);
        $addCheese = $request->input('cheese', false);
    
        // Ensure pepperoni is not added to large pizzas
        if ($size == 'large') {
            $addPepperoni = false;
        }
        $prices = [
            'small' => 15,
            'medium' => 22,
            'large' => 30,
        ];

        $pepperoniPrices = [
            'small' => 3,
            'medium' => 5,
        ];

        $cheesePrice = 6;

        $totalPrice = $prices[$size];
        if ($addPepperoni) {
            $totalPrice += $pepperoniPrices[$size];
        }
        if ($addCheese) {
            $totalPrice += $cheesePrice;
        }

        $order = [
            'size' => $size,
            'addPepperoni' => $addPepperoni,
            'addCheese' => $addCheese,
            'price' => $totalPrice
        ];

        $cart = Session::get('cart', []);
        $cart[] = $order;

        // dd($cart, $order);
        Session::put('cart', $cart);

        return response()->json(['order' => $order]);

    }

    public function showCart()
    {
        $cart = Session::get('cart', []);
        $total = array_sum(array_column($cart, 'price'));
        return view('cart', ['cart' => $cart, 'total' => $total]);
    }

    public function clearCart()
    {
        Session::forget('cart');
        return response()->json(['success' => true]);
    }
}
