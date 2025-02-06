<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Validator;

class InvoiceController extends Controller
{
    // Display a listing of the resource.

    public function index()
    {
        $invoices = Invoice::where('user_id', auth()->user()->user_id)->get();
        return view('user.invoice.list', compact('invoices'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('invoices.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [

            'billing_to' => 'nullable|string|max:255',
            'service_item' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'quantity' => 'required|integer',
            'tax_percentage' => 'required|numeric',
            'gst_percentage' => 'required|numeric',
            'late_fee_amount' => 'required|numeric',
            'billing_from' => 'required|string',
            'additional_notes' => 'required|string',
        ]);
        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = [
                'message' => reset($messages)[0],
                'status' => 'error', 'code' => 500
            ];
        } else {

            if ($request->invoice_id == '') {
                Invoice::create(
                    [
                        'user_id' => auth()->user()->user_id,
                        // 'amount' => $request->quantity * $request->rate,
                        // 'issue_date' => date('Y-m-d'),
                        // 'due_date' => $request->due_date,
                        'is_paid' => 0,
                        'business_name' => $request->billing_to,
                        'service_item' => $request->service_item,
                        'rate' => $request->rate,
                        'quantity' => $request->quantity,
                        'tax_percentage' => $request->tax_percentage,
                        'gst_percentage' => $request->gst_percentage,
                        'late_fee_type' => 'Fixed',
                        'late_fee_amount' => $request->late_fee_amount,
                        'billing_address' => $request->billing_from,
                        'currency' => 'USD',
                        'is_details_saved' => 1,
                        'additional_notes' => $request->additional_notes,
                    ]
                );
                $response = [
                    'message' => 'Invoice created successfully',
                    'status' => 'success', 'code' => 201
                ];
            } else {

                Invoice::where('invoice_id', $request->invoice_id)->update(
                    [
                        'user_id' => auth()->user()->user_id,
                        // 'amount' => $request->quantity * $request->rate,
                        // 'issue_date' => date('Y-m-d'),
                        // 'due_date' => $request->due_date,
                        'is_paid' => 0,
                        'business_name' => $request->billing_to,
                        'service_item' => $request->service_item,
                        'rate' => $request->rate,
                        'quantity' => $request->quantity,
                        'tax_percentage' => $request->tax_percentage,
                        'gst_percentage' => $request->gst_percentage,
                        'late_fee_type' => 'Fixed',
                        'late_fee_amount' => $request->late_fee_amount,
                        'billing_address' => $request->billing_from,
                        'currency' => 'USD',
                        'is_details_saved' => 1,
                        'additional_notes' => $request->additional_notes,
                    ]
                );
                $response = [
                    'message' => 'Invoice Updated successfully',
                    'status' => 'success', 'code' => 201
                ];
            }
        }
        return response()->json($response);
    }



    // Display the specified resource.
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    // Show the form for editing the specified resource.
    public function edit(Request $request)
    {
        $invoices = Invoice::where('invoice_Id', $request->invoice_Id);
        if ($invoices->count() > 0) {

            $response = [
                'message' => $invoices->first(),
                'status' => 'success', 'code' => 200
            ];
        } else {

            $response = [
                'message' => 'Not Found' . $request->invoice_Id,
                'status' => 'error', 'code' => 404
            ];
        }

        return response()->json($response);
    }

    // Update the specified resource in storage.
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'amount' => 'required|numeric',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
            'is_paid' => 'required|boolean',
            'business_name' => 'nullable|string|max:255',
            'service_item' => 'required|string|max:255',
            'rate' => 'required|numeric',
            'quantity' => 'required|integer',
            'tax_percentage' => 'required|numeric',
            'gst_percentage' => 'required|numeric',
            'late_fee_type' => 'required|string|max:255',
            'late_fee_amount' => 'required|numeric',
            'billing_address' => 'required|string',
            'currency' => 'required|string|max:10',
            'is_details_saved' => 'required|boolean',
        ]);

        $invoice->update($request->all());

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }
}
