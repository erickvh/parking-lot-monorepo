<?php

namespace App\Http\Controllers;

use App\services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

    public function getResidentReport(Request $request)
    {
        $data = $this->paymentService->getResidentReport($request);
    }
}
