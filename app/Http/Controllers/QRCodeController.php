<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

use App\Models\StaffQRCode;

class QRCodeController extends Controller
{
    public function staffQrcode(){
        $staff_qr_codes = StaffQRCode::all();
       // Chuyển đổi hình ảnh thành base64 cho mỗi mã QR
    //    foreach ($staff_qr_codes as $staff_qr_code) {
    //         $path = public_path('images/QR/' . $staff_qr_code->image);
    //         // dd(file_exists($path));
    //         if (file_exists($path)) {
    //             $staff_qr_code->base64_image = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
    //         } else {
    //             $staff_qr_code->base64_image = null;
    //         }
    //     }
    //      dd($staff_qr_codes);
        return view('staff_qr_code',compact('staff_qr_codes'));
    }

    public function generateQrCode(Request $request)
    {
        // Validate the request
        $request->validate([
            'staff_id' => 'required|string',
            'name' => 'required|string',
        ]);
    
        // Get input values
        $staffId = $request->input('staff_id');
        $full_name = $request->input('name');
        $name = $this->removeVietnameseAccent($request->input('name'));
        
        // Combine text
        $text = "$staffId";
    
    
        // Create a QR code
        $qrCode = new QrCode($text);
        $writer = new PngWriter();
    
        // Write the QR code to a string
        $result = $writer->write($qrCode);
        $qrImage = $result->getString();
    
        // Define the path and filename
        $filePath = public_path('images/QR/');
        $fileName = $staffId . '.png';
    
        // Ensure directory exists
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0755, true);
        }
    
        // Save the QR code image to the public directory
        $fileFullPath = $filePath . $fileName;
        File::put($fileFullPath, $qrImage);
    
        if(StaffQRCode::where('code', $staffId)->exists()){
            StaffQRCode::where('code', $staffId)->update([
                'image' => $fileName,
                'name' => $full_name,
            ]);
        } else {
            StaffQRCode::create([
                'image' => $fileName,
                'code' => $staffId,
                'name' => $full_name,
            ]);
        }
        
        // Optionally, you can return a success message and redirect
        return redirect()->back()->with('success', 'Mã QR đã được tạo và lưu thành công!');
    }

    function removeVietnameseAccent($str) {
        $transliterationTable = [
            'à'=>'a','á'=>'a','ạ'=>'a','ả'=>'a','ã'=>'a','â'=>'a','ầ'=>'a','ấ'=>'a','ậ'=>'a','ẩ'=>'a','ẫ'=>'a','ă'=>'a','ằ'=>'a','ắ'=>'a','ặ'=>'a','ẳ'=>'a','ẵ'=>'a',
            'è'=>'e','é'=>'e','ẹ'=>'e','ẻ'=>'e','ẽ'=>'e','ê'=>'e','ề'=>'e','ế'=>'e','ệ'=>'e','ể'=>'e','ễ'=>'e',
            'ì'=>'i','í'=>'i','ị'=>'i','ỉ'=>'i','ĩ'=>'i',
            'ò'=>'o','ó'=>'o','ọ'=>'o','ỏ'=>'o','õ'=>'o','ô'=>'o','ồ'=>'o','ố'=>'o','ộ'=>'o','ổ'=>'o','ỗ'=>'o','ơ'=>'o','ờ'=>'o','ớ'=>'o','ợ'=>'o','ở'=>'o','ỡ'=>'o',
            'ù'=>'u','ú'=>'u','ụ'=>'u','ủ'=>'u','ũ'=>'u','ư'=>'u','ừ'=>'u','ứ'=>'u','ự'=>'u','ử'=>'u','ữ'=>'u',
            'ỳ'=>'y','ý'=>'y','ỵ'=>'y','ỷ'=>'y','ỹ'=>'y',
            'đ'=>'d',
            'À'=>'A','Á'=>'A','Ạ'=>'A','Ả'=>'A','Ã'=>'A','Â'=>'A','Ầ'=>'A','Ấ'=>'A','Ậ'=>'A','Ẩ'=>'A','Ẫ'=>'A','Ă'=>'A','Ằ'=>'A','Ắ'=>'A','Ặ'=>'A','Ẳ'=>'A','Ẵ'=>'A',
            'È'=>'E','É'=>'E','Ẹ'=>'E','Ẻ'=>'E','Ẽ'=>'E','Ê'=>'E','Ề'=>'E','Ế'=>'E','Ệ'=>'E','Ể'=>'E','Ễ'=>'E',
            'Ì'=>'I','Í'=>'I','Ị'=>'I','Ỉ'=>'I','Ĩ'=>'I',
            'Ò'=>'O','Ó'=>'O','Ọ'=>'O','Ỏ'=>'O','Õ'=>'O','Ô'=>'O','Ồ'=>'O','Ố'=>'O','Ộ'=>'O','Ổ'=>'O','Ỗ'=>'O','Ơ'=>'O','Ờ'=>'O','Ớ'=>'O','Ợ'=>'O','Ở'=>'O','Ỡ'=>'O',
            'Ù'=>'U','Ú'=>'U','Ụ'=>'U','Ủ'=>'U','Ũ'=>'U','Ư'=>'U','Ừ'=>'U','Ứ'=>'U','Ự'=>'U','Ử'=>'U','Ữ'=>'U',
            'Ỳ'=>'Y','Ý'=>'Y','Ỵ'=>'Y','Ỷ'=>'Y','Ỹ'=>'Y',
            'Đ'=>'D'
        ];
    
        // Thay thế các ký tự có dấu bằng các ký tự không dấu
        return strtr($str, $transliterationTable);
    }
    
    
    
}
