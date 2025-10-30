<?php

namespace App\Http\Controllers;

use App\Jobs\StorePlayPoster;
use App\Models\Category;
use App\Models\Play;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.play.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.play.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'duration' => 'required|numeric|min:0',
            'short_description' => 'nullable|max:300',
            'description' => 'nullable|max:5000',
            'poster' => 'required|image|mimes:jpg,jpeg,webp,png',
            'ticket_url' => 'required|url|active_url',
            'price' => 'required|numeric|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'numeric|exists:categories,id'
        ]);

        $play = Play::create($validated);

        $tempPath = $request->file('poster')->store('temp');

        StorePlayPoster::dispatch($play, $tempPath);

        if($request->has('categories'))
        {
            $play->categories()->sync($validated['categories']);
        }

        return redirect()->route('admin.crew.create', $play)
            ->with('alert', ['message' => 'Претставата беше успешно додадена.']);
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
    public function edit(Play $play)
    {
        return view('admin.pages.play.edit', [
            'play' => $play,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Play $play)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'duration' => 'nullable|numeric|min:0', // changed to nullable so that it doesn't require updating if not provided
            'short_description' => 'nullable|max:300',
            'description' => 'nullable|max:5000',
            'poster' => 'nullable|image|mimes:jpg,jpeg,webp,png',
            'ticket_url' => 'required|url|active_url',
            'price' => 'required|numeric|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'numeric|exists:categories,id',
        ]);

        $play->update($validated);

        if($request->has('categories')){
            $play->categories()->sync($validated['categories']);
        }

        if ($request->hasFile('poster')) {
            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_PRIVATE_KEY'),
                env('IMAGE_KIT_URL_END_POINT')
            );

            $imageKit->deleteFile($play->image_kit_id);

            $fileData = base64_encode(file_get_contents($request->file('poster')->getPathname()));
            $fileName = time() . '-' . $request->file('poster')->getClientOriginalName();

            $uploadFile = $imageKit->upload([
                "file" => $fileData,
                "fileName" => $fileName,
                "folder" => "/teatar-komedija/plays",
            ]);

            if (isset($uploadFile->result) && isset($uploadFile->result->url)) {
                $play->poster = $uploadFile->result->url;
                $play->image_kit_id = $uploadFile->result->fileId;
                $play->save();
            }
        }

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Претставата беше успешно зачувана.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Play $play)
    {
        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT')
        );

        $imageKit->deleteFile($play->image_kit_id);

        $play->delete();

        return redirect()->route('admin.play.index')
            ->with('alert', ['message' => 'Преставата беше успешно избришана.']);
    }
}
