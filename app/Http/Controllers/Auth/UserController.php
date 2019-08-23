<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 7/31/19
 * Time: 10:24 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('auth.index', compact('users'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roleList = Role::all();
        return view('auth.edit', compact('user', 'roleList'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        $user = User::findOrFail($id);
        $user->update($data);
        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }
        Session::flash('success', 'User has been updated successfully');
        return redirect(route('users.index'));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $deposit = Deposit::where('depositor_id', $user->id)->get();
        if (!$deposit->isEmpty()) {
            Session::flash('error', 'User has deposit, so cannot be deleted');
            return redirect(route('users.index'));
        }

        $user->roles()->detach();
        $user->delete();
        Session::flash('success', 'User has been deleted successfully');
        return redirect(route('users.index'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }
}