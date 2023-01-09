<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    public function index(Product $product)
    {
        $users = User::withCount(['products'])
                            ->get()
                            ->all();
        return view('layouts.users',compact('users'));
                               
    }

    function validate_newUser(Request $request)
    {
        $request->validate([
            'name'         =>   'required|unique:users',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
            'image'        =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role'         =>   'required|not_in:0'
        ]);

        $data = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'assets/img';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'image' =>  $data['image'],
            'role' =>  $data['role']

        ]);

        return redirect()->back()->with('message','User added successfully');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);

    }

    public function updateUser(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'role'  => 'required'
            
        ]);
   
        $data = $request->all();

        $user->update($data);
     
        return redirect()->back()->with('message','User updated successfully');

    }

    public function delete(User $user)
    {
        $user->delete();
      
        return redirect()->route('users')
                        ->with('message','User deleted successfully');
    }
}
