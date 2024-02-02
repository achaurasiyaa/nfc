<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemNfcRel;
use App\Item;
use App\User;
use App\IssueRecord;
use App\Worker;
use App\Vendor;

class NfcController extends Controller
{
    public function assignToWorker($nfc_serial_number)
    {
        dd('k');
        // Retrieve the NFC item based on the serial number
        $nfcItem = ItemNfcRel::where('nfc_serial_number', $nfc_serial_number)->first();

        if (!$nfcItem) {
            // Handle the case when the NFC item is not found
            abort(404, 'NFC Item not found');
        }

        // Get the currently logged-in user
        $user = auth()->user();

        if (!$user) {
            // Redirect or handle the case when no user is logged in
            return redirect()->route('login')->with('error', 'Please log in to assign the NFC item.');
        }

        // Check if the request is an AJAX request
        if (request()->ajax()) {
            // Handle the AJAX search request
            $workers = $this->searchWorkers(request('query'));

            return response()->json(['workers' => $workers]);
        }

        // Render the Blade view for assigning the NFC item
        return view('nfc.assign', ['nfcItem' => $nfcItem]);
    }

    private function searchWorkers($query)
    {
        // Search for workers by name or gate_pass_number
        return Worker::where('name', 'like', "%$query%")
            ->orWhere('gate_pass_number', 'like', "%$query%")
            ->get();
    }
    
    public function show($nfc_serial_number)
    {
      
      $nfcItem = ItemNfcRel::where('nfc_serial_number', $nfc_serial_number)->first();
            // dd($nfcItem);
      if (!$nfcItem) {
          
          abort(404);
      }
      $issueRecord = IssueRecord::where('nfc_tag_id', $nfcItem->id)->first();
    //   $user = auth()->user();
    //   if ($user) {
    //  dd('l');
    //     return view('nfc.show', [
    //         'nfcItem' => $nfcItem,
    //         'worker' => $worker,
    //         'vendor' => $vendor,
    //         'gatePassNumber' => $worker->gate_pass_number,
    //     ]);
    //     // return view('nfc.show',['nfc_serial_number' => $nfc_serial_number]);
    //     // Redirect or handle the case when no user is logged in
    //     // return redirect()->route('login')->with('error', 'Please log in to assign the NFC item.');
    // }
      

      if ($issueRecord) {
          $worker = Worker::find($issueRecord->worker_id);
          $vendor = Vendor::find($worker->vendor_id);
          return view('nfc.show', [
              'nfcItem' => $nfcItem,
              'worker' => $worker,
              'vendor' => $vendor,
              'gatePassNumber' => $worker->gate_pass_number,
          ]);
      } else {
          $this->assignToWorker($nfc_serial_number,$nfcItem);
      }
    }
}
