<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $contact_no = $request->contact_no;
        $orders = new Paginator([], 0);

        if (!empty($contact_no)) {
            $customer = Customer::where('contact_no', $contact_no)->first();

            if (!blank($customer)) {
                $orders = $customer->orders()->latest()->paginate(10);
            } else {
                $new_customer = Customer::updateOrCreate(
                    ['contact_no' => $contact_no]
                );
                $orders = $new_customer->orders()->latest()->paginate(10);
            }
        }

        return view('orders.show', compact('orders', 'contact_no'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'order_no' => 'required|string',
            'contact_no' => 'required|string',
            'date' => 'required|string'
        ]);

        $order_no = $request->get('order_no');
        $contact_no = $request->get('contact_no');
        $date = $request->get('date');

        Customer::where('contact_no', $contact_no)
            ->first()
            ->orders()
            ->create([
                'order_no' =>  $order_no,
                'date' => $date
            ]);

        return redirect()->route('orders.index', ['contact_no' => $contact_no]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back();
    }
}
