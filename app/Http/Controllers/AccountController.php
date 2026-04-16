<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderByDesc('created_at')->limit(5)->get();

        return view('account.dashboard', compact('user', 'orders'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->orderByDesc('created_at')->get();

        return view('account.orders', compact('orders'));
    }

    public function orderDetail(string $orderNumber)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->with('items')
            ->firstOrFail();

        return view('account.order-detail', compact('order'));
    }

    public function cancelOrder(Request $request, string $orderNumber)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if (! $order->isCancellable()) {
            return back()->withErrors(['status' => 'This order can no longer be cancelled.']);
        }

        $data = $request->validate([
            'cancel_reason' => 'nullable|string|max:500',
        ]);

        DB::table('orders')->where('id', $order->id)->update([
            'status'        => 'cancelled',
            'cancel_reason' => $data['cancel_reason'] ?? null,
            'updated_at'    => now(),
        ]);

        // Restock items.
        foreach ($order->items as $item) {
            if ($item->product_id) {
                try {
                    Product::where('id', $item->product_id)->increment('stock', (int) $item->quantity);
                } catch (\Throwable $e) {
                    // best-effort
                }
            }
        }

        return redirect()->route('account.order.detail', $order->order_number)
            ->with('success', 'Your order has been cancelled.');
    }

    public function returnOrder(Request $request, string $orderNumber)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if (! $order->isReturnable()) {
            return back()->withErrors(['status' => 'Returns can only be requested for delivered orders.']);
        }

        $data = $request->validate([
            'return_reason' => 'required|string|max:500',
        ]);

        DB::table('orders')->where('id', $order->id)->update([
            'status'        => 'return_requested',
            'return_reason' => $data['return_reason'],
            'updated_at'    => now(),
        ]);

        return redirect()->route('account.order.detail', $order->order_number)
            ->with('success', 'Return request submitted. Our team will contact you shortly.');
    }

    public function profile()
    {
        return view('account.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'    => 'required|string|max:150',
            'phone'   => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'city'    => 'nullable|string|max:100',
            'state'   => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
        ]);

        DB::table('users')->where('id', $user->id)->update(array_merge($data, ['updated_at' => now()]));

        return back()->with('success', 'Profile updated.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'current_password' => 'required|string',
            'password'         => ['required', 'confirmed', Password::min(6)],
        ]);

        if (! Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        DB::table('users')->where('id', $user->id)->update([
            'password'   => Hash::make($data['password']),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Password updated.');
    }
}
