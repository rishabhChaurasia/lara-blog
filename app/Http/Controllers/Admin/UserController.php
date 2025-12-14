<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = User::query()
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%"))
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->latest()
            ->paginate(10);

        return view('admin.user', compact('users'));

    }

    public function create()
    {

        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required',
            'email'          => 'required|email|unique:users',
            'password'       => 'required|min:6',
            'role'           => 'required',
            'avatar'         => 'nullable|image|max:1024',
            'bio'            => 'nullable',
            'social_links'   => 'nullable|array',
            'social_links.*' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (isset($data['social_links'])) {
            $data['social_links'] = json_encode($data['social_links']);
        }

        User::create($data);

        return redirect()->route('admin.user')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $data = $request->validate([
            'name'           => 'required',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'role'           => 'required',
            'avatar'         => 'nullable|image|max:1024',
            'bio'            => 'nullable',
            'social_links'   => 'nullable|array',
            'social_links.*' => 'nullable|string',
        ]);

        if ($request->hasFile('avatar')) {

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (isset($data['social_links'])) {
            $data['social_links'] = json_encode($data['social_links']);
        }

        $user->update($data);

        return redirect()->route('admin.user')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User deleted successfully');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }
}
