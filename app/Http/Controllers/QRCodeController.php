<?php
  
namespace App\Http\Controllers;

use   QrCode;
use Illuminate\Http\Request;


  
class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function simpleQr()
    {
        
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000123, 9999999456)
            . mt_rand(1000000123, 9999999456)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $string = str_shuffle($pin);
        
    //    return QrCode::size(300)->generate($string.time());
    $cod = $string.time();
        QrCode::size(300)->generate($string.time());
        return $cod;
    }  

    public function colorQr()
    {
              return QrCode::size(300)
                     ->backgroundColor(255,55,0)
                     ->generate('Color QR code example');
    }    

    public function imageQr()
    {
       

        $image = QrCode::format('png')
                 ->merge('app/public/laravel.png', 0.5, true)
                 ->size(500)->errorCorrection('H')
                 ->generate('Image qr code example');
        return response($image)->header('Content-type','image/png');
    }

    public function emailQrCode()
    {
        return QrCode::size(500)
                ->email('talladiopp@gmail.com', 'Welcome to Lara Tutorials!', 'This is !.');
    }  
    public function qrCodePhone()
    {
             QrCode::phoneNumber('111-222-6666');
    }    
    public function textQrCode()
    {
      QrCode::SMS('111-222-6666', 'Body of the message');
    }


    // public function qrcodesave()
    // {

    //     $qr_code = new generateRandomStringController();
    //     $qr_code->generateRandomString();

    //      QrCode::size(500)
    //         ->format('png')
    //         ->generate($qr_code, storage_path('app/public/qrcodes/'.$qr_code.'.png'));

    //         return $qr_code;
    // }
   
   
}