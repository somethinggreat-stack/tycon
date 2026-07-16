<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Store an order placed from the checkout page.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['nullable', 'string', 'max:160'],
            'email'   => ['required', 'email', 'max:160'],
            'phone'   => ['nullable', 'string', 'max:40'],
            'plan'    => ['nullable', 'string', 'max:160'],
            'amount'  => ['nullable', 'string', 'max:40'],
            'source'  => ['nullable', 'string', 'max:40'],
            'address' => ['nullable', 'string', 'max:400'],
        ]);

        // derive a numeric amount from the display value ("$1,000.00" -> 1000.00)
        $data['amount_value'] = (float) preg_replace('/[^0-9.]/', '', (string) ($data['amount'] ?? '0'));
        $data['status'] = 'reserved';

        $order = Order::create($data);

        return response()->json([
            'ok'      => true,
            'message' => 'Your order is reserved. Our team will be in touch shortly.',
            'id'      => $order->id,
        ]);
    }
}
