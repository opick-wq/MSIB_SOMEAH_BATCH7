<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Http\Resources\CustomerCollection;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return new CustomerCollection($customers);
    }



    public function insertCustomer() {
        $customers = [
            [
                'customer_name' => 'Khisan Afif',
                'email' => 'khisanafif@gmail.com',
                'phone_number' => '0812345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Muhammad Sultan',
                'email' => 'sultan@gmail.com',
                'phone_number' => '0812987654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Ingrid',
                'email' => 'ingrid@gmail.com',
                'phone_number' => '0812487434',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Amanda',
                'email' => 'manda@gmail.com',
                'phone_number' => '0813567564',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Franky',
                'email' => 'franky@yahoo.com',
                'phone_number' => '0813452345',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($customers as $data) {
            DB::table('customers')->insert([
                'customer_name' => $data['customer_name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return response()->json(['status' => 200, 'message' =>  'Data customer berhasil ditambahkan'], 200);
    }

    public function getAllcustomers() {
        $customer = DB::table('customer')->get();
        // dd($customer);
        return response()->json(['status' => 200, 'data' => $customer]);
    }
    
    public function getcustomersWithCondition() {
        $customer = DB::table('customer')->where('email', 'like', '%@gmail.com')->get();
        // dd($customer);
        return response()->json(['status' => 200, 'data' => $customer]);
    }

    public function updateCustomer($id){
        DB::table('customer')->where('id', $id)->update([
            'customer_name' => 'Franky',
            'email' => 'franky@gmail.com',
            'phone_number' => '0813452345',
            'updated_at' => now(),
        ]);
        return response()->json(['status' => 200, 'message' =>  'produk berhasil diupdate']);
    }

    public function deleteCustomer($id) {
        DB::table('customer')->where('id', $id)->delete();
        return response()->json(['status' => 200, 'message' =>  'produk berhasil dihapus']);
    }
    
    public function showQueryLog() {
        DB::enableQueryLog();
        $customer = DB::table('customer')->get();
        $queries = DB::getQueryLog();
        dd($queries);
        return response()->json($customer);
    }
}
