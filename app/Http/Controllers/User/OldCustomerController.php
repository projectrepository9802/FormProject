<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class OldCustomerController extends Controller
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $custID = $_GET['id'];
            $custData = Customer::where('id_pelanggan', $custID)->first();
            if ($custData) {
                $datas = [
                    'titlePage' => 'Customer Lama',
                    'oldCustData' => $custData
                ];

                return view('user.pages.oldcustomer.detailcust', $datas);
            } else {
                return back()->with('errorNotif', 'Data Tidak Ditemukan. Silahkan Coba Lagi');
            }
        } else {
            $datas = [
                'titlePage' => 'Customer Lama'
            ];
            return view('user.pages.oldcustomer.indexcust', $datas);
        }
    }
}
