<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportInstancesResidents implements FromView
{
    private $totals = [];
    public function __construct($data)
    {
        $this->totals = $data;
    }

    public function view(): View
    {
        return view('exports.totals-residents', [
            'totals' => $this->totals
        ]);
    }
}
