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

       $apartments = Apartment::where('visible',true)
                ->orderBy('created_at', 'desc')
                ->paginate(8); //set how many result for page
 
        
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
    public function list(){

        $apartmentList = Apartment::with(['user', 'additionalServices']);

        // if($request -> keyword){
        //     // this will allow user to search for a specific apartment by his title
        //     $apartmentQuery -> where('title', 'LIKE', '%'.$request->keyword.'%');
        // }

        $apartments = $apartmentList -> get();

        return response() -> json([

            'message' => 'Apartments successfully fetched',
            'data' => $apartments
        ]);
    }

    public function filter(Request $request){

        $latitude = $request["latitude"];
        $longitude = $request["longitude"];
        $radius = $request["radius"];
        $room_number = $request["room_number"];
        $bed_number = $request["bed_number"];

        $haversine = "(
            6371 * acos(
                cos(radians(" . $latitude . "))
                * cos(radians(`latitude`))
                * cos(radians(`longitude`) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . ")) * sin(radians(`latitude`))
            )
            
            )";
        
        $apartments = Apartment::select("*")
            ->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $radius)
            ->orderby("distance", "desc")
            ->get();


        if(isset($room_number)){

            $apartments = Apartment::select("*")
            ->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $radius)
            ->having("room_number", ">=", $room_number)
            ->orderby("distance", "desc")
            ->get();        
        }

        if(isset($bed_number)){

            $apartments = Apartment::select("*")
            ->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $radius)
            ->having("room_number", ">=", $room_number)
            ->having("bed_number", ">=", $bed_number)
            ->orderby("distance", "desc")
            ->get();
        }


        return response()->json([
            "success" => true,
            "apartments" => $apartments,
        ]);
    }
    public function visibility(Request $request,Apartment $apartment){


        // cerchiamo l'appartamento in base all'id
        $apartment = Apartment :: find($apartment -> id);

        // prendiamo la richiesta e la assegniamo alla colonna visible
        $apartment -> visible = $request -> visible;
        
        $apartment -> save();
        
       
        return response() -> json([
            'success' => "Visibilità dell'appartamento aggiornata con success"
        ]);
    }

}