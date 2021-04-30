<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Rules\Uppercase;
use App\Http\Requests\CreateValidationRequest;
use Illuminate\Support\Facades\Storage;

class CarsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth', ['except' => ['index, show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();

        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // CreateValidationRequest
    {
//        $car = new Car;
//        $car->name = $request->input('name');
//        $car->founded = $request->input('founded');
//        $car->description = $request->input('description');
//        $car->save();

//        $request->validated();

        $request->validate([
            'name' => 'required',
            'founded' => 'required|min:0|max:2021',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:5048'  // max size in kb
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        Car::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

        $products = Product::find($id);

        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  // CreateValidationRequest
    {
        // $request->validated();

        $request->validate([
            'name' => 'required',
            'founded' => 'required|min:0|max:2021',
            'description' => 'required',
        ]);

        $car = Car::where('id', $id)->first();

        if ($request->image) {
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png|max:5048'  // max size in kb
            ]);

            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $oldImagePath = 'images/' . $car->image_path;
        }

        $car->update([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $newImageName ?? $car->image_path,
            'user_id' => auth()->user()->id
        ]);

        if ($request->image) {
            $request->image->move(public_path('images'), $newImageName);
            unlink($oldImagePath);
        }

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect('/cars');
    }
}
