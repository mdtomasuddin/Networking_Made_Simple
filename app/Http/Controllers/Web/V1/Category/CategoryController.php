<?php

namespace App\Http\Controllers\Web\V1\Category;

use App\Helpers\Helper;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch categories with selected columns and order by latest
            $data = Category::select(['id', 'name', 'image', 'status'])->latest();

            // Using DataTables to format the response for AJAX requests
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = asset($row->image);
                    return '<img src="' . $url . '" style="height: 50px; width:50px; object-fit:cover;" class="rounded border">';
                })
                ->addColumn('status', function ($row) {
                    $checked = ($row->status === 'active' || $row->status === 1) ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center">
                            <input onclick="changeStatus(event, ' . $row->id . ')" type="checkbox" class="form-check-input" role="switch" ' . $checked . '>
                        </div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="' . route('categories.edit', $row->id) . '" class="btn btn-sm btn-info-soft">
                               <i class="bi bi-pencil-square"></i>
                            </a>
                            <button onclick="deleteRecord(event, ' . $row->id . ')" class="btn btn-sm btn-danger-soft">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.category.index');
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('backend.layouts.category.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);
        try {
            // Check if an image file is uploaded
            if ($request->hasFile('image')) {
                $uploaded               = Helper::uploadFile($request->file('image'), 'category');
                $validatedData['image'] = $uploaded;
            }
            // Create a new category with the validated data
            Category::create($validatedData);
            // Return a success response
            return redirect()->route('categories.index')->with('t-success', 'Category Create successfully!');
        } catch (Exception $e) {
            // Handle the exception
            return response()->json([
                'success' => false,
                'message' => 'Category not created',
            ]);
        }
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        // Find the category by ID
        $data = Category::findOrFail($id);

        // Pass the category data to the view
        return view('backend.layouts.category.edit', compact('data'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name'  => 'nullable|string|max:200',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        try {
            // Find the category by ID
            $data = Category::findOrFail($id);
            // Check if a new image file is uploaded
            if ($request->hasFile('image')) {
                if ($data && $data->image) {
                    Helper::deleteFile($data->image);
                }
                $uploaded               = Helper::uploadFile($request->file('image'), 'category');
                $validatedData['image'] = $uploaded;
            }
            // Update the category with the validated data
            $data->update($validatedData);
            return redirect()->route('categories.index')->with('t-success', 'Category updated successfully!');
        } catch (Exception $e) {
            // Handle the exception
            return redirect()->back()->withInput()->with('t-error', $e->getMessage());
        }
    }

    // Delete the specified resource from storage.
    public function destroy(string $id)
    {
        try {
            // Find the category by ID
            $data = Category::findOrFail($id);

            // Delete the image
            if (! empty($data->image)) {
                Helper::deleteFile($data->image);
            }

            $data->delete();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully.',
            ]);
        } catch (Exception $e) {
            // Handle the exception
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    //Change the status of the specified resource from storage.
    public function status(Request $request, $id)
    {
        // Find the category by ID
        $data = Category::find($id);

        // If category not found, return a 404 response
        if (! $data) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found.',
            ], 404);
        }

        $data->status = ($data->status == 'active') ? 'inactive' : 'active';
        $data->save();
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.',
        ]);
    }
}
