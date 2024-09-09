<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function qrcode(Request $request)
    {
        if ($request->has('account_number') && $request->has('account_owner_name')) {
            // dd($request->account_number, $request->account_owner_name);
            // Gán giá trị account_number từ request vào URL
            $accountNumber = $request->account_number;
            $accountOwnerName = $request->account_owner_name;
            $shop_name = $request->shop_name ?? '';
            $qrCode = "https://img.vietqr.io/image/970415-{$accountNumber}-qr_only.png";
            return view('qr_code',compact('qrCode', 'accountNumber', 'accountOwnerName','shop_name'));
        }
        return view('qr_code');
    }
}
