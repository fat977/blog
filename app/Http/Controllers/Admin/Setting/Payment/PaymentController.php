<?php

namespace App\Http\Controllers\Admin\Setting\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Payment\PaymentStoreRequest;
use App\Http\Requests\Admin\Payment\PaymentUpdateRequest;
use App\Models\PaymentMethod;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    use ImageTrait;
    public function index()
    {
        $payments = PaymentMethod::all();

        return view('admin.settings.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.settings.payments.create');
    }

    public function store(PaymentStoreRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->uploadImage($request->file('logo'), 'public/images');
        }

        PaymentMethod::query()->create([
            'name' => $validated['name'],
            'logo' => $validated['logo'],
            'description' => $validated['description'],
            'is_active' => $validated['is_active'] == 'on' ? true : false,
            'settings' => json_encode($validated['settings']),
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', __('admin/setting/payment/payment.messages.create'));
    }

    public function edit(PaymentMethod $payment)
    {
        return view('admin.settings.payments.edit', compact('payment'));
    }

    public function update(PaymentUpdateRequest $request, PaymentMethod $payment)
    {
        $validated = $request->validated();

        // store logo
        if ($request->hasFile('logo')) {
            if ($payment->logo) {
                //Remove old logo
                Storage::disk('local')->delete('public/images/' . $payment->logo);
            }
            $validated['logo'] = $this->uploadImage($request->file('logo'), 'public/images');
        }

        $payment->update([
            'name' => $validated['name'],
            'logo' => $validated['logo'] ?? $payment->logo,
            'description' => $validated['description'],
            'is_active' => isset($validated['is_active']) ? 1 : 0,
            'settings' => json_encode($validated['settings']),
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', __('admin/setting/payment/payment.messages.edit'));
    }

    public function destroy(PaymentMethod $payment)
    {
        $payment->delete();

        if ($payment->logo) {
            //Remove old logo
            Storage::disk('local')->delete('public/images/' . $payment->logo);
        }

        return redirect()->route('admin.payments.index');
    }

    public function changeActive(PaymentMethod $payment)
    {
        $payment->update([
            'is_active' => !$payment->is_active,
        ]);

        return redirect()->back()
            ->with('success', __('admin/setting/payment/payment.messages.edit_active'));
    }
}
