<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Validator;

class coba_controller extends Controller
{
    //with ajax
    public function read_file(Request $request)
    {
        $file = $request->file('file');

        return $this->encrypt($file, $request->code);
    }
    private function encrypt($file, $key)
    {
        $dkey = base64_decode($key);

        //check length of key
        if (strlen($dkey) != 32) {
            $array = array(
              'error' => 'true',
              'message' => 'Code not valid'
            );
            return $array;
        }

        $encrypter = new Encrypter($dkey, 'AES-256-CBC');
        $fileDir = pathinfo($file->getRealPath());

        $handle = fopen($file, 'r');
        $txt = '';
        if ($handle) {
            while (!feof($handle)) {
                $plaintext = fgetss($handle);
                $ciphertext = $encrypter->encrypt($plaintext);
                if (feof($handle)) {
                    $txt .= $ciphertext;
                } else {
                    $txt .= $ciphertext."\r\n";
                }
            }
            fclose($handle);
            $array = array(
              'error' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'.enc',
              'message' => $txt
            );
            return $array;
        }
    }
}
