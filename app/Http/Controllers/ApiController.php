<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AdditionalService;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Sponsorship;
use App\Models\User;
use App\Models\View;

class ApiController extends Controller
{

    // Index function displaying list of apartments
    public function index()
    {

        $apartments = Apartment::with('additionalServices')
            ->orderBy('created_at', 'desc')
            ->get();

        // $additionalServices = AdditionalService::all();

        return response()->json([

            'success' => true,
            'response' => [

                'apartments' => $apartments,
                // 'additionalServices' => $additionalServices
            ]
        ]);
    }

    // Store function creating new obj
    public function store(Request $request)
    {

        $data = $request->validate([

            'title' => 'required | string | min: 10',
            'description' => 'nullable | text',
            'room_number' => 'required | tinyInteger | min: 1',
            'bed_number' => 'required | tinyInteger | min: 1',
            'bath_number' => 'required | tinyInteger | min: 1',
            'square_meters' => 'required | smallInteger | min: 40',
            'address' => 'required | string | min: 5',
            'latitude' => 'nullable |float',
            'longitude' => 'nullable | float',
            'img' => 'required | string',
            'additional_services_id' => 'nullable | array'

        ]);

        $apartment = Apartment::create($data);

        if (array_key_exists('additional_services_id', $data)) {

            $additional_services = AdditionalService::find($data['additional_services_id']);
            $apartment->additionalServices()->sync($additional_services);
        }

        return response()->json([
            'success' => true,
            'response' => $apartment,
            'data' => $request->all()
        ]);
    }
}