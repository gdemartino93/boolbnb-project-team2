<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AdditionalService;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Sponsorship;
use App\Models\User;
use App\Models\View;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{

    // Index function displaying list of apartments
    public function index()
    {

        $apartments = Apartment::with('additionalServices')
            ->orderBy('created_at', 'desc')
            ->paginate(4); //set how many result for page
        
        return response()->json([

            'success' => true,
            'response' => [

                'apartments' => $apartments,
            ]
        ]);
    }

    public function signleAp($id)
    {

        $apartment = Apartment::with('additionalServices')->find($id);

        return response()->json([
            'success' => true,
            'response' => $apartment
        ]);
    }

    // Store function creating new obj
    public function store(Request $request)
    {

        $user = $request->user();

        $data = $request->validate([

            'title' => 'required | string',
            'description' => 'nullable | string',
            'room_number' => 'required | int | min: 1',
            'bed_number' => 'required | int | min: 1',
            'bath_number' => 'required | int | min: 1',
            'square_meters' => 'required | int | min: 40',
            'address' => 'required | string | min: 5',
            'latitude' => 'nullable', //
            'longitude' => 'nullable',
            // image only accept jpeg,png,jpg,gif,svg format and max size 2048
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_services' => 'nullable',

        ]);

        // upload image to storage and get the path
        $path = $request->file('img')->store('public/apartments');

        // get the name of the image, we will use it to display the image
        $name = env('APP_URL') . '/storage/' . $path;

        // add the name of the image to the data array
        $data['img'] = $name;
        // prendiamo l'appartamento creato associato all'utente.
        $apartment = $user->apartments()->create($data);

        if (array_key_exists('additional_services', $data)) {

            $additional_services = AdditionalService::find($data['additional_services']);
            $apartment->additionalServices()->sync($additional_services);
        }


        return response()->json([
            'success' => true,
            'response' => $apartment,
            'data' => $request->all()
        ]);
    }
    public function updateServices(Request $request, Apartment $apartment)
    {
        $apartment->additionalServices()->detach();
        $apartment->additionalServices()->sync($request->all());
    }
    public function update(Request $request, Apartment $apartment)
    {
        $user = $request->user();

        $data = $request->validate([

            'title' => 'required | string',
            'description' => 'nullable | string',
            'room_number' => 'required | int | min: 1',
            'bed_number' => 'required | int | min: 1',
            'bath_number' => 'required | int | min: 1',
            'square_meters' => 'required | int | min: 40',
            'address' => 'required | string | min: 5',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'additional_services' => 'nullable',
            // image only accept jpeg,png,jpg,gif,svg format and max size 2048
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        
        // upload image to storage and get the path if the user upload a new image
        if ($request->img) {
       
            // upload using storage 
            Storage::disk('public')->put('apartments', $request->file('img'));

            // get the name of the image, we will use it to display the image
            $name = env('APP_URL') . '/storage/apartments/' . $request->file('img')->hashName();

            // add the name of the image to the data array , yes you got it
            $data['img'] = $name;

        }
      
        $apartment->update($data);
        $apartment->user()->associate($user);
        $apartment->save(); 

        if (array_key_exists('additional_services', $data)) {

            $additional_services = AdditionalService::find($data['additional_services']);
            $apartment->additionalServices()->sync($additional_services);
        }


        return response()->json([
            'success' => true,
            'response' => $apartment,
            'data' => $request->all()
        ]);

    }

    public function dashboardList(Request $request)
    {

        $user = $request->user();
        $apartments = $user->apartments;

        return response()->json($apartments);
    }

    public function delete(Apartment $apartment)
    {
        $apartment->sponsorships()->sync([]);
        $apartment->additionalServices()->sync([]);

        $apartment->views()->delete();
        $apartment->messages()->delete();
        $apartment->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function getAdditionalServices()
    {

        $additional_services = AdditionalService::orderBy('name', 'asc')->get();

        return response()->json([

            'success' => true,
            'response' => [

                'additional_service' => $additional_services,
            ]
        ]);
    }

    // List of apartments without pagination
    public function list(Request $request){

        $apartmentQuery = Apartment::with(['user', 'additionalServices']);

        $apartments = $apartmentQuery -> get();

        return response() -> json([

            'message' => 'Apartments successfully fetched',
            'data' => $apartments
        ]);
    }

}