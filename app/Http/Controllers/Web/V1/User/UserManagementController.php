<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class UserManagementController
{
    /**
     * Display a listing of the users.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'first_name', 'last_name', 'email', 'phone', 'job_title', 'company_name', 'location', 'status', 'created_at', 'avatar', 'handle'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->filterColumn('name', function ($query, $keyword) {
                    $sql = "CONCAT(first_name,' ',last_name)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->orderColumn('name', function ($query, $order) {
                    $query->orderBy('first_name', $order)->orderBy('last_name', $order);
                })
                ->addColumn('avatar', function ($row) {
                    $avatar = $row->avatar ? asset($row->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($row->first_name . ' ' . $row->last_name);
                    return '<img src="' . $avatar . '" style="height: 50px; width:50px; object-fit:cover;" class="rounded border">';
                })
                ->addColumn('name', function ($row) {
                    $name   = '<span class="text-nowrap">' . trim($row->first_name . ' ' . $row->last_name) . '</span>';
                    $handle = $row->handle ? '<br><small class="text-muted">@' . $row->handle . '</small>' : '';
                    return $name . $handle;
                })
                ->editColumn('phone', function ($row) {
                    return $row->phone ?? 'N/A';
                })
                ->editColumn('job_title', function ($row) {
                    return $row->job_title ? Str::limit($row->job_title, 20) : 'N/A';
                })
                ->editColumn('company_name', function ($row) {
                    return $row->company_name ? Str::limit($row->company_name, 20) : 'N/A';
                })
                ->editColumn('location', function ($row) {
                    return $row->location ? Str::limit($row->location, 20) : 'N/A';
                })
                ->addColumn('status', function ($row) {
                    $checked = ($row->status === 'active') ? 'checked' : '';
                    return '<div class="form-check form-switch d-flex justify-content-center">
                            <input onclick="changeStatus(event, ' . $row->id . ')" type="checkbox" class="form-check-input" role="switch" ' . $checked . '>
                        </div>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('M d, Y');
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="#" class="btn btn-sm btn-info-soft" title="View Details">
                               <i class="bi bi-eye"></i>
                            </a>
                            <button onclick="deleteRecord(event, ' . $row->id . ')" class="btn btn-sm btn-danger-soft">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>';
                })
                ->rawColumns(['avatar', 'name', 'status', 'action'])
                ->make(true);
        }
        // Render the view
        return view('backend.layouts.user.index');
    }

    /**
     * Delete the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Fetch the user by ID
            $user = User::findOrFail($id);
            // Optionally delete related files if needed
            $user->delete();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.',
            ]);
        } catch (Exception $e) {
            // Return an error response if deletion fails
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Change the status of the specified resource.
     */
    public function status(Request $request, $id)
    {
        // Fetch the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        // Toggle the user's status
        $user->status = ($user->status == 'active') ? 'suspended' : 'active';
        $user->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'User status updated successfully.',
        ]);
    }
}
