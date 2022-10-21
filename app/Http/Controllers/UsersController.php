<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\StoreUserFormRequest;
use App\Http\Requests\StoreAdminFormRequest;
use App\Http\Requests\UpdateAdminFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password as PasswordRules;

class UsersController extends Controller
{

    public function index()
    {

        return view("users.index", ['users' => User::all()->where('role', '!=', 'super_admin')]);
    }

    public function create()
    {
        return view("users.create");
    }

    public function store(StoreUserFormRequest $request)
    {
        $input = $request->safe()->only(['firstname', 'lastname', 'email', 'role', 'password']);
        $user = User::create($input);
        return redirect(route('users.index') . "#" . $user->id)/*->with('success', "Le compte utilisateur à bien été créé.")*/;
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(UpdateUserFormRequest $request, User $user)
    {
        $input = $request->safe()->only(['firstname', 'lastname', 'email', 'role']);
        $user->update($input);
        return redirect(route('users.index') . "#" . $user->id)/*->with('success', "Le compte utilisateur a bien été mis à jour.")*/;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'));
    }

    public function changePass(User $user)
    {
        return view('users.edit_pass', ['user' => $user]);
    }

    public function updatePass(Request $request, User $user)
    {
        $input = $request->validate([
            'password' => [
                'required',
                'max:191',
                'confirmed',
                PasswordRules::min(4)
                    -> letters()
                    ->uncompromised(),
            ],
        ]);
        if (Auth::user() == $user) {
            $user->update($input);
            Auth::login($user);
        } else {
            $user->update($input);
        }
        return redirect(route('users.index') . "#" . $user->id)/*->with('success', "Le mot de passe de l'utilisateur à bien été mis à jour.")*/;
    }

    /*
    public function changeRole(User $user)
    {
        if (Auth::user() == $user) {
            return redirect(route('user.index') . "#" . $user->id)->with('error', "Vous ne pouvez pas changer votre propre role. Demandez à un autre administrateur.");
        }
        return view('users.edit_role', ['user' => $user]);

    }

    public function updateRole(Request $request, User $user)
    {
        if (Auth::user() == $user) {
            return redirect(route('user.index') . "#" . $user->id)->with('error', "Vous ne pouvez pas changer votre propre role. Demandez à un autre administrateur.");
        }

        $attributes = $request->validate([
            'role' => [
                'required',
                new Enum(RoleEnum::class),
            ],
        ]);
        $user->update($attributes);
        return redirect(route('users.index') . "#" . $user->id)->with('success', "Le role de l'utilisateur a bien été mis à jour.");
    }*/
}
