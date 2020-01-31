<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Users list page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(4);
        return view('users.index', compact('users'));
    }

    /**
     * User create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return  view('users.create');
    }

    /**
     * Stores new user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:100'
        ]);
        $request->merge([
            'password' => app('hash')->make($request->input('password', 'password'))
        ]);
        $user = User::create($request->only(['name', 'email', 'password']));
        return redirect()->route('users.index')->with('success', "User $user->name created");
    }

    /**
     * Existing user's edit form
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Updates user's data by editing form
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => ['required', 'email' , Rule::unique('users')->ignore($user->id, 'id')],
            'password' => 'nullable|string|min:6|max:100'
        ]);
        if ($request->has('password')){
            $request->merge([
                'password' => app('hash')->make($request->input('password', 'password'))
            ]);
        }
        $user->update($request->only(['name', 'email', 'password']));
        return redirect()->route('users.index')->with('success', "$user->name user's data  was updated");
    }

    /**
     * Deletes user instance
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user_name = $user->name;
        $user->delete();
        return redirect()->back()->with('success', "User $user_name was deleted");
    }
}
