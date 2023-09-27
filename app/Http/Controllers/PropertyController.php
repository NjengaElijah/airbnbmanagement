<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Feature;
use App\Models\Photo;
use App\Models\Room;
use App\Models\RoomFeature;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $rooms = Room::where(['deleted' => 0])->get();
       
        return view('properties.index',compact('rooms'));
    }
    public function uploadImage($id,UploadImageRequest $request)
    {
        
        $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $filename);

        // save uploaded image filename here to your database
        $photo = new Photo;
        $photo->photoable_type = Room::class;
        $photo->photoable_id = $id;
        $photo->path = $filename;
        $photo->save();

        return back()
            ->with(['success' => 1, 'msg' => 'Image uploaded successfully.']);


    }
    public function create(Request $request)
    {

        if ($request->isMethod('GET')) {
            $clients = Client::all();
            return view('partials.modal', [
                'title' => 'Add Room',
                'action' => route('property_add'),
                'body' => view('properties.create',compact('clients')),
                'submit_text' => 'Save',
            ])->render();
        }
        // dd("..");
        $request->validate(['name' => 'required']);

         Room::create(
            [
                'name' => $request->name,
                'description' => $request->description ?? "",
                'client_id' => $request->client_id,
                'price_per_night' => $request->price_per_night,
                'discounted_price' => $request->discounted_price,
                'location' => $request->location??"",
                'coordinates' => $request->coordinates ?? "",
                'no_guests' => $request->no_guests ?? 1,
                'deleted' => 0,
                'status' => 1
                
            ]
        );
        // dd($client->fresh());
        return back()->with([
            'success' => 0,
            'msg' => 'feature registered'
        ]);

    }
    public function view($id,Request $request)
    {
        $property = Room::find($id);
        
        return view('properties.view', compact('property'));
    }
    public function assignFeature($id, Request $request)
    {
        RoomFeature::create(['room_id' => $id, 'feature_id' => $request->feature_id]);
        return back()->with([
            'success' => 0,
            'msg' => 'feature added'
        ]);

    }
    public function deletePhoto($id,Request $request)
    {
       $photo = Photo::find($id);
       
        if ($request->isMethod('GET')) {

            return view('partials.confirm', [
                'action' => route('remove_image',$id),
                'body' => "Delete feature <b>".$photo->name."</b>",
                'method' => 'DELETE'
            ])->render();
        }
       
       $photo->delete();
        return back()->with([
            'success' => 1,
            'msg' => 'photo deleted   '
        ]);
    }
    public function deAssignFeature($id, Request $request)
    {
        RoomFeature::where(['room_id' => $id, 'feature_id' => $request->feature_id])->delete();
        return back()->with([
            'success' => 0,
            'msg' => 'feature deleted   '
        ]);

    }
    public function edit()
    {
    }
    public function delete($id, Request $request)
    {
        $property = Room::find($id);

        if ($request->isMethod('GET')) {

            return view('partials.confirm', [
                'action' => route('property_delete', $id),
                'body' => "Delete property <b>" . $property->name . "</b>",
                'method' => 'DELETE'
            ])->render();
        }
        // dd("..");
        $property->update(['deleted' => 1]);
        return redirect()->route('properties')->with([
            'success' => 0,
            'msg' => 'property deleted'
        ]);

    }
    public function bookings(Request $request)
    {
        $bookings = Booking::all();


        return view('properties.bookings.index',compact('bookings'));
    }
}
