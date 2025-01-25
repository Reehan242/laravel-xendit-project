<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //You can change the value of this apiKey from .env->"MY_API_KEY"  or change it on config/app.php->"api-key"
        $apiKey = config('app.api-key');
        Configuration::setXenditKey($apiKey);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::all();

        return view('welcome', array('products' => $product));
    }

    public function detail($id)
    {
        $product = Product::find($id);

        return view('detail-product', array('product' => $product));
    }

    public function payment(Request $request)
    {
        // Check data product
        $product = Product::find($request->id);

        $uuid = (string) Str::uuid();

        // Call xendit
        $apiInstance = new InvoiceApi();
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => $uuid,
            'description' => $product->description,
            'amount' => $product->price,
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            "customer" => [
                "given_names" => $request->name,
                "email" => $request->email,
            ],
            "success_redirect_url" => "http://127.0.0.1:8000",
          "failure_redirect_url"=> "http://127.0.0.1:8000",
        ]);

        try {
            $result = $apiInstance->createInvoice($createInvoiceRequest);

            // Insert to table Order
            $order = new Order();
            $order->product_id = $product->id;
            $order->checkout_link = $result['invoice_url'];
            $order->external_id = $uuid;
            $order->status = "pending";
            $order->save();

            return redirect($result['invoice_url']);

        } catch (\Xendit\XenditSdkException $e) {

        }
    }

    public function notification($id){
        $apiInstance = new InvoiceApi();

        $result = $apiInstance->getInvoices(null, $id);
        
        // Get Data
        $order = Order::where('external_id', $id)->firstOrFail();

        if($order->status == 'SETTLED'){
            return response()->json('Payment anda telah berhasil di proses');
        }

        // Update status
        $order->status = $result[0]['status'];
        $order->save();

        return response()->json('Success');
    }
}
