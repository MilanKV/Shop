<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);

        $users = User::orderBy('created_at', 'desc')->paginate($perPage);
        $users->appends(['perPage' => $perPage]);
        return view('backend.pages.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        // Validate the incoming request
        $validatedData = $request->validated();

        // Handling file upload for user image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/backend/users/user_images');
            $validatedData['image'] = str_replace('public/', '', $imagePath);
        }

        // Create a new user with the validated data
        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
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
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    public function deactivated(User $user)
    {
        $users = User::onlyTrashed()->get();

        return view('backend.pages.Users.deactivated', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id)->restore();

        return redirect()->back()->with('success', 'User restored successfully.');
    }

    public function permanentDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        // Delete the user's image from storage if it exists
        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }

        $user->forceDelete();

        return redirect()->back();
    }
}
