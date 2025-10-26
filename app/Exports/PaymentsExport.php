<?php
namespace App\Exports;

use App\Models\Payment;
use App\Models\Purpose;
use App\Models\Bibag;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentsExport implements FromView
{
    protected $fromDate;
    protected $toDate;
    protected $purpose_id;
    protected $bibag_id;

    public function __construct($fromDate, $toDate, $purpose_id, $bibag_id)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->purpose_id = $purpose_id;
        $this->bibag_id = $bibag_id;
    }

    public function view(): View
    {
        $query = Payment::with('sreni', 'bibag', 'purpose')->latest();

        if ($this->fromDate) {
            $query->whereDate('payments.created_at', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('payments.created_at', '<=', $this->toDate);
        }

        if ($this->purpose_id) {
            $query->where('payments.purpose_id', $this->purpose_id);
        }

        if ($this->bibag_id) {
            $query->where('payments.bibag_id', $this->bibag_id);
        }

        $payments = $query->get();
        $totalAmount = $payments->sum('amount');

        $bibagName = $this->bibag_id ? Bibag::find($this->bibag_id)?->name : null;
        $purposeName = $this->purpose_id ? Purpose::find($this->purpose_id)?->name : null;

        return view('admin.payment.export_pdf', [
            'payments' => $payments,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'totalAmount' => $totalAmount,
            'bibagName' => $bibagName,
            'purposeName' => $purposeName,
        ]);
    }
}


    // public function view(): View
    // {
    //     $query = Payment::with('sreni', 'bibag')->latest();

    //     if ($this->fromDate) {
    //         $query->whereDate('payments.created_at', '>=', $this->fromDate);
    //     }

    //     if ($this->toDate) {
    //         $query->whereDate('payments.created_at', '<=', $this->toDate);
    //     }

    //     if ($this->purpose_id) {
    //         $query->where('payments.purpose_id', $this->purpose_id);
    //     }

    //     if ($this->bibag_id) {
    //         $query->where('payments.bibag_id', $this->bibag_id);
    //     }

    //     $payments = $query->get();

    //     return view('admin.payment.export_pdf', [
    //         'payments' => $payments,
    //         'fromDate' => $this->fromDate,
    //         'toDate' => $this->toDate,

    //     ]);
    // }

