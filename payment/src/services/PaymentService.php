<?php

namespace App\services;

use Exception;
use Illuminate\Support\Facades\Http;
use stdClass;

class PaymentService
{

    public function parseResidentData($data)
    {
        $result = [];
        $resultObject = [];

        foreach ($data as $instance) {
            if (array_key_exists($instance['vehicle']['plate'], $result)) {
                $result[$instance["vehicle"]["plate"]][0] += (float) $instance['amount'];
                $result[$instance["vehicle"]["plate"]][1] += $instance['minutes'];
            } else {
                $result[$instance["vehicle"]["plate"]] = [(float) $instance["amount"], $instance["minutes"]];
            }
        }

        foreach ($result as $key => $value) {
            $total = new stdClass();
            $total->plate = $key;
            $total->amount = $value[0];
            $total->minutes = $value[1];
            $resultObject[] = $total;
        }


        return $resultObject;
    }

    public function getResidentReport($request)
    {
        $result = [];

        try {
            $response = Http::withHeaders(["Authorization" => "Bearer " . $request->bearerToken()])
                ->get(getenv("MS_PARKING_URL") . "/parking/instances");

            $data = $response->json();
            $result = $this->parseResidentData($data);
        } catch (\Exception $e) {

            return $result;
        }
        return $result;
    }


    public function restartMonth($request)
    {
        try {
            $response = Http::withHeaders(["Authorization" => "Bearer " . $request->bearerToken()])
                ->delete(getenv("MS_PARKING_URL") . "/parking/instances");
            if ($response->status() != 200)  return ["message" => "Error on restart month"];
        } catch (Exception $e) {
            return ["message" => "Error on restart month"];
        }

        return ["message" => "Month restarted"];
    }


    public function payInstanceVisitor($request, $id)
    {
        $data = null;
        try {
            $response =     Http::withHeaders(["Authorization" => "Bearer " . $request->bearerToken()])
                ->put(getenv("MS_PARKING_URL") . "/parking/instances/$id/paid");

            if ($response->status() != 200) return ["message" => "Error on pay instance visitor"];

            $data = $response->json();
        } catch (Exception $e) {
            return ["message" => "Error on pay instance visitor"];
        }

        return ["message" => "Instance visitor paid", "data" => $data];
    }
}
