<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeImage;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ImageKit\ImageKit;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.employee.create', [
            'positions' => JobPosition::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'job_position_id' => 'required|exists:job_positions,id',
            'description' => 'nullable|max:5000',
            'images' => 'nullable|array',
            'images.*' => 'mimes:webp,jpg,jpeg,png|image|max:10240',
        ]);

        $employee = Employee::create($validated);

        if ($request->hasFile('images')) {
            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_PRIVATE_KEY'),
                env('IMAGE_KIT_URL_END_POINT')
            );

            // Filter out nulls to prevent errors
            $images = array_filter($request->file('images'));

            foreach ($images as $image) {
                $fileData = base64_encode(file_get_contents($image->getPathname()));
                $fileName = time() . '-' . $image->getClientOriginalName();

                $uploadFile = $imageKit->upload([
                    "file" => $fileData,
                    "fileName" => $fileName,
                    "folder" => "/teatar-komedija/employees",
                ]);

                if (isset($uploadFile->result) && isset($uploadFile->result->url)) {
                    EmployeeImage::create([
                        'employee_id' => $employee->id,
                        'path' => $uploadFile->result->url,
                        'image_kit_id' => $uploadFile->result->fileId
                    ]);
                }
            }
        }

        return redirect()->route('admin.employee.index')
            ->with('alert', ['message' => $employee->getFullName() . ' беше успешно додаден.']);
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
    public function edit(Employee $employee)
    {
        return view('admin.pages.employee.edit', [
            'employee' => $employee,
            'positions' => JobPosition::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'job_position_id' => 'required|exists:job_positions,id',
            'description' => 'nullable|max:5000',
            'images' => 'nullable|array',
            'images.*' => 'mimes:webp,jpg,jpeg,png|image|max:10240',
        ]);

        $employee->update($validated);

        if ($validated['images']) {
            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_PRIVATE_KEY'),
                env('IMAGE_KIT_URL_END_POINT')
            );

            try {
                $imageKit->bulkDeleteFiles($employee->images->pluck("image_kit_id")->toArray());
                $employee->images()->delete();
            } catch (\Exception $e) {
                Log::error('Failed to delete employee images: ' . $e->getMessage(), [
                    'employee_id' => $employee->id,
                    'trace' => $e->getTraceAsString(),
                ]);

                return redirect()->route('admin.employee.index')
                    ->with('alert', [
                        'message' => 'Се случи грешка при бришење на сликите.',
                        'type' => 'error'
                    ]);
            }
            foreach ($validated['images'] as $image) {
                $fileData = base64_encode(file_get_contents($image->getPathname()));
                $fileName = time() . '-' . $image->getClientOriginalName();

                $uploadFile = $imageKit->upload([
                    "file" => $fileData,
                    "fileName" => $fileName,
                    "folder" => "/teatar-komedija/employees",
                ]);

                if (isset($uploadFile->result) && isset($uploadFile->result->url)) {
                    EmployeeImage::create([
                        'employee_id' => $employee->id,
                        'path' => $uploadFile->result->url,
                        'image_kit_id' => $uploadFile->result->fileId
                    ]);
                }
            }
        }

        return redirect()->route('admin.employee.index')
            ->with('alert', ['message' => 'Успешно беа зачувани измените.']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $imageKit = new ImageKit(
                env('IMAGE_KIT_PUBLIC_KEY'),
                env('IMAGE_KIT_PRIVATE_KEY'),
                env('IMAGE_KIT_URL_END_POINT')
            );

            $imageKit->bulkDeleteFiles($employee->images->pluck('image_kit_id')->toArray());
            $employee->delete();

            return redirect()->route('admin.employee.index')
                ->with('alert', ['message' => 'Успешно беше избришан вработениот.']);
        } catch (\Exception $e) {
            // Optionally log the error
            Log::error('Failed to delete employee: ' . $e->getMessage());

            return redirect()->route('admin.employee.index')
                ->with('alert', [
                    'type' => 'error',
                    'message' => 'Настана грешка при бришење на вработениот.'
                ]);
        }
    }
}
