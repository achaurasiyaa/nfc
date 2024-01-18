<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemNfcRel;
use App\Item;

class NfcController extends Controller
{
    public function show($nfc_serial_number)
    {

        // Retrieve the NFC item based on the serial number
        $nfcItem = ItemNfcRel::where('nfc_serial_number', $nfc_serial_number)->first();
        // $itemDetails = $nfcItem->item;
        // dd($itemDetails);
       
        if ($nfcItem) {
            // Assuming you have a blade view named 'nfc.show'
            return view('nfc.show', ['nfcItem' => $nfcItem]);
        } else {
            // Handle the case when the NFC item is not found
            abort(404);
        }
    }
}
