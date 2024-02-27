<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ItemNfcRel;
use App\IssueRecord;
use App\Worker;
use App\Vendor;

class NfcController extends Controller
{
    public function show($nfc_serial_number)
    {
        $nfcItem = ItemNfcRel::where('nfc_serial_number', $nfc_serial_number)->first();
        $gatePassNumbers = Worker::all()->pluck('gate_pass_number')->toArray();
        if (!$nfcItem) {
            abort(404);
        }

        $issueRecord = IssueRecord::where('nfc_tag_id', $nfcItem->id)->with('worker')->first();
        $showAssignButton = true;
        if ($issueRecord && $issueRecord->worker_id) {
            $worker = Worker::find($issueRecord->worker_id);
            return view('nfc.show', [
                'nfcItem' => $nfcItem,
                'worker' => $worker,
                'issueRecord' => $issueRecord,
                'showAssignButton' => $showAssignButton,
                'gatePassNumbers' => $gatePassNumbers,
            ]);
        } else {
            if (Auth::check()) {
                return view('nfc.show_unassigned', [
                    'nfcItem' => $nfcItem,
                    'showAssignButton' => $showAssignButton,
                    'gatePassNumbers' => $gatePassNumbers,
                ]);
            } else {
                return redirect()->route('login')->with('error', 'You need to be logged in to assign a worker.');
            }
        }
    }

    public function assignWorker($nfc_serial_number)
    {
        $nfcItem = ItemNfcRel::where('nfc_serial_number', $nfc_serial_number)->first();

        if (!$nfcItem) {
            abort(404);
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to assign a worker.');
        }

        $gatePassNumber = request()->input('gate_pass_number');
        $worker = Worker::where('gate_pass_number', $gatePassNumber)->first();

        if ($worker) {
            $issueRecord = new IssueRecord();
            $issueRecord->worker_id = $worker->id;
            $issueRecord->issue_date = now();
            $issueRecord->nfc_tag_id = $nfcItem->id;
            $issueRecord->save();

            return redirect()->route('nfc.show', ['nfc_serial_number' => $nfc_serial_number])->with('success', 'Worker assigned successfully.');
        } else {
            return back()->with('error', 'Worker not found');
        }
    }

}
