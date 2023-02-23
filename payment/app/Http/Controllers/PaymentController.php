<?php

namespace App\Http\Controllers;

use App\Exports\ExportInstancesResidents;
use App\services\PaymentService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

    public function getResidentReport(Request $request)
    {
        $totals = $this->paymentService->getResidentReport($request);
        $content = Excel::raw(new ExportInstancesResidents($totals), \Maatwebsite\Excel\Excel::CSV);
        $response =  response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="report.csv"');

        return $response;
    }


    public function restartMonth(Request $request)
    {

        return $this->paymentService->restartMonth($request);
    }


    public function payInstanceVisitor(Request $request, $id)
    {
        return $this->paymentService->payInstanceVisitor($request, $id);
    }
}
