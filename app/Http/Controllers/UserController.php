<?php

namespace App\Http\Controllers;

use App\Models\{User , Role };
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
      return view('pages.previlages.user_role' , compact('users' , 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(UserRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('profile_img')) {

        $image = $request->file('profile_img');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(
            public_path('uploads/users'),
            $imageName
        );

        $data['profile_img'] = $imageName;
    }

    $user = User::create($data);

    $user->roles()->sync($request->roles);

    return redirect()->back()->with(
        'success',
        'User Created Successfully'
    );
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(UserUpdateRequest $request, User $user)
{
    $data = $request->validated();

    // Password sirf tab update hoga jab new password diya gaya ho
    if ($request->filled('password')) {

        $data['password'] = Hash::make($request->password);

    } else {

        unset($data['password']);
    }

    // New image upload hui hai
    if ($request->hasFile('profile_img')) {

        // Old image delete
        if ($user->profile_img) {

            $oldImage = public_path(
                'uploads/users/' . $user->profile_img
            );

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        // New image store
        $image = $request->file('profile_img');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(
            public_path('uploads/users'),
            $imageName
        );

        $data['profile_img'] = $imageName;
    }

    // User update
    $user->update($data);

    return redirect()->back()->with(
        'success',
        'User Updated Successfully'
    );
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success','User Deleted Successfully');

    }

     //EDIT PERMISSIONS
    public function edit_roles(Request $request)
    {
         $role = User::find($request->id);
         $role->roles()->sync($request->roles);
         return redirect()->back()->with('success','Roles Updated SuccessFully');
    }
    // SEARCH INSTRUCTOR
public function search(Request $request)
{
    $search = $request->search;

    $users = User::where('name', 'LIKE', '%' . $search . '%')
        ->whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })
        ->select('id', 'name')
        ->limit(10)
        ->get()
        ->map(function ($user) {

            return [
                'id'   => $user->id,
                'text' => $user->name,
            ];

        });

    return response()->json($users);
}
}
