<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.activity.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'image' => 'required|image|mimes:jpg,jpeg,webp,png',
            'category_id' => 'required|in:1,2,3,4'
        ]);

        $validated['date'] = Carbon::parse($validated['date'] . ' ' . $validated['time']);

        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT'),
        );

        $file = $request->file('image');
        $uploadedFile = $imageKit->uploadFile([
            'file' => fopen($file->getPathname(), 'r'),
            'fileName' => time() . '-' . $file->getBasename() . $file->getClientOriginalExtension(),
            'folder' => '/teatar-komedija/activities'
        ]);

        if (isset($uploadedFile->result) && isset($uploadedFile->result->url)) {
            $validated['image'] = $uploadedFile->result->url;
            $validated['image_kit_id'] = $uploadedFile->result->fileId;
            Activity::create($validated);

            return redirect()->route('admin.activity.index')
                ->with('alert', ['message' => 'Активноста беше успешно додадена']);
        }

        return redirect()->route('admin.activity.index')
            ->with('alert', ['message' => 'Имаше грешка при додавањето на активноста ве молиме пробајте подцна.', 'type' => 'errro']);
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
    public function edit(Activity $activity)
    {
        return view('admin.pages.activity.edit', [
            'activity' => $activity
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpg,jpeg,webp,png',
            'category_id' => 'required|in:1,2,3,4'
        ]);

        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->short_description = $request->short_description;
        $activity->category_id = $request->category_id;
        $activity->date = Carbon::parse($request->date . ' ' . $request->time);

        if ($request->hasFile('image')) {

            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_PRIVATE_KEY'),
                env('IMAGE_KIT_URL_END_POINT'),
            );

            $imageKit->deleteFile($activity->image_kit_id);

            $file = $request->file('image');
            $uploadedFile = $imageKit->uploadFile([
                'file' => fopen($file->getPathname(), 'r'),
                'fileName' => time() . '-' . $file->getBasename() . $file->getClientOriginalExtension(),
                'folder' => '/teatar-komedija/activities'
            ]);

            $activity->image = $uploadedFile->result->url;
            $activity->image_kit_id = $uploadedFile->result->fileId;
        }

        $activity->save();

        return redirect()->route('admin.activity.index')
            ->with('alert', ['message' => 'Измените беа успешно зачувани.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {

        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT'),
        );

        $imageKit->deleteFile($activity->image_kit_id);

        $imageKitIds = $activity->images->pluck('image_kit_id')->toArray();
        $imageKit->bulkDeleteFiles($imageKitIds);

        $activity->delete();

        return to_route('admin.activity.index')->with('alert', ['message' => 'Активноста беше успешно избришана.']);
    }
}
