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
            ]
        ]);
    }

    // Store function creating new obj
    public function store(Request $request)
    {

        $user = $request ->user();

        $data = $request->validate([

            'title' => 'required | string | min: 10',
            'description' => 'nullable | string',
            'room_number' => 'required | int | min: 1',
            'bed_number' => 'required | int | min: 1',
            'bath_number' => 'required | int | min: 1',
            'square_meters' => 'required | int | min: 40',
            'address' => 'required | string | min: 5',
            'latitude' => 'nullable |int',
            'longitude' => 'nullable | int',
            'img' => 'required | string',
            'additional_services' => 'nullable',

        ]);
        // prendiamo l'appartamento creato associato all'utente.
        $apartment = $user ->apartments() -> create($data);
       

        if (array_key_exists('additional_services', $data)) {

            $additional_services = AdditionalService::find($data['additional_services']);
            $apartment->additionalServices()->sync($additional_services);
        }
        dd($apartment);

        return response()->json([
            'success' => true,
            'response' => $apartment,
            'data' => $request->all()
        ]);
    }

    public function dashboardList(Request $request){

        $user = $request -> user();
        $apartments = $user -> apartments;

        return response() -> json($apartments);
    }

    public function delete(Apartment $apartment)
    {
        $apartment -> additionalServices() -> sync([]);
        $apartment -> sponsorships() -> sync([]);
        $apartment -> delete();

        return response() ->json([
            'success' => true
        ]);
    }

}