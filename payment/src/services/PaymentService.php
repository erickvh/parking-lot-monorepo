<?php

namespace App\services;

use Illuminate\Support\Facades\Http;

class PaymentService
{

    public function getResidentReport($request)
    {
        $result = [];

        try {
            $response = Http::withHeaders(["Authorization" => "Bearer " . $request->bearerToken()])
                ->get(getenv("MS_PARKING_URL") . "/parking/instances");


            if ($response->successful()) {
                $result = $response->json();
            }
        } catch (\Exception $e) {
            return $result;
        }


        return $result;
    }
}
