<?php

namespace App\Http\Controllers;

use App\Jobs\StorePlayImage;
use App\Models\Play;
use App\Models\PlayImage;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Play $play)
    {
        return view('admin.pages.image.create', [
            'play' => $play
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Play $play)
    {
        $validated = $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:png,jpg,jpeg,webp|max:5120'
        ]);


        foreach ($request->images as $image) {
            $path = $image->store('temp');
            StorePlayImage::dispatch($play, $path);
           
        }

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Сликите беа успешно додадени']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlayImage $image)
    {
        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT'),
        );

        $imageKit->deleteFile($image->image_kit_id);

        $image->delete();

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Сликата беше успешно избиришана.']);
    }
}
