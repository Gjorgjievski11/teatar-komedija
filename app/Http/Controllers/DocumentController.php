<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use ImageKit\ImageKit;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.document.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.document.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|in:1,2,3,4',
            'sub_category_id' => 'required|in:1,2,3,4,5,6,7,8',
            'description' => 'required',
            'file' => 'required|file'
        ]);

        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT')
        );

        // dd($request->file('file')->getPathname());

        $uploadFile = $imageKit->upload([
            'file' => fopen($request->file('file')->getPathname(), 'r'),
            'fileName' => time() . '-' . basename($validated['file']) . '.' . $request->file('file')->getClientOriginalExtension(),
            'folder' => '/teatar-komedija/documents'
        ]);

        if (isset($uploadFile->result) && isset($uploadFile->result->url)) {
            $validated['image_kit_id'] = $uploadFile->result->fileId;
            $validated['url'] = $uploadFile->result->url;
            Document::create($validated);

            return redirect()->route('admin.document.index')
                ->with('alert', ['message' => 'Документот беше успешно додаден.', 'type' => 'success']);
        }

        return redirect()->route('admin.document.index')
            ->with('alert', ['message' => 'Имаше грешка при додавенењ на доментот. Ве молиме пробајте подоцна', 'type' => 'success']);
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
    public function edit(Document $document)
    {
        return view('admin.pages.document.edit', ['document' => $document]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'category_id' => 'required|in:1,2,3,4',
            'sub_category_id' => 'required|in:1,2,3,4,5,6,7,8',
            'description' => 'required',
            'file' => 'nullable|file'
        ]);

        $document->category_id = $validated['category_id'];
        $document->sub_category_id = $validated['sub_category_id'];
        $document->description = $validated['description'];

        if ($request->has('file')) {
            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_PRIVATE_KEY'),
                env('IMAGE_KIT_URL_END_POINT')
            );

            $imageKit->deleteFile($document->image_kit_id);

            $uploadFile = $imageKit->upload([
                'file' => fopen($request->file('file')->getPathname(), 'r'),
                'fileName' => time() . '-' . basename($validated['file']) . '.' . $request->file('file')->getClientOriginalExtension(),
                'folder' => '/teatar-komedija/documents'
            ]);

            if (isset($uploadFile->result) && isset($uploadFile->result->url)) {
                $document->image_kit_id = $uploadFile->result->fileId;
                $document->url = $uploadFile->result->url;
            }
        }
        $document->save();

        return   redirect()->route('admin.document.index')->with('alert', ['message' => 'Промените беа успешно зачувани.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_PRIVATE_KEY'),
            env('IMAGE_KIT_URL_END_POINT')
        );

        $imageKit->deleteFile($document->image_kit_id);

        $document->delete();

        return redirect()->route('admin.document.index')->with('alert', ['message' => 'Документот беше успешно избришан.']);
    }
}
