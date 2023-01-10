<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{

//--------------------------------------------------------------------------------
//--------------------------------Auth--------------------------------------------
//--------------------------------------------------------------------------------

        public function signin()
        {
            return view('layouts.auth.signin');
        }

        public function signup()
        {
            return view('layouts.auth.signup');
        }

        public function validate_signup(Request $request)
        {
            $request->validate([
                'name'             =>   'required|unique:partners',
                'email'            =>   'required|email|unique:partners',
                'password'         =>   'required|min:6',
                'confirm_password' =>   'required|same:password',
                'image'            =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $data = $request->all();

            if ($image = $request->file('image')) {
                $destinationPath = 'assets/img';
                $profileImage = $image->getClientOriginalName();
                $image->move($destinationPath, $profileImage);
                $data['image'] = "$profileImage";
            }

            Partner::create([
                'name'  =>  $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['password']),
                'image' =>  $data['image']

            ]);

            return redirect('signin')->with('message', 'Sign up Completed, now you can login!');
        }

        public function validate_signin(Request $request)
        {
            $request->validate([
                'email' =>  'required',
                'password'  =>  'required'
            ]);

            $credentials = $request->only('email', 'password');

            if(Auth::attempt($credentials))
            {
                return redirect('dashboard');
            }

            return redirect('signin')->with('error', 'sign in details are not valid');
        }

        public function logout()
        {
            Session::flush();

            Auth::logout();

            return Redirect('signin')->with('info', 'you loged out from your account');
        }

        public function dashboard()
        {
                if(Auth::check())
                {
                    return view('layouts.dashboard');
                }

                return redirect('signin')->with('error', 'you are not allowed to access');
        }
        
//--------------------------------------------------------------------------------
//-------------------------------Profile------------------------------------------
//--------------------------------------------------------------------------------

    public function profile(Partner $partner)
    {
            return view('layouts.profile',compact('partner'));
    }

    public function updateProfile(Request $request, Partner $partner)
    {


            $request->validate([
                'name'         =>   [   
                                        'required',
                                        Rule::unique('partners')->ignore($partner->id),
                                    ],
                'email'        =>   [
                                        'required',
                                        'email',
                                        Rule::unique('partners')->ignore($partner->id),
                                    ],

            ]);

                $data = $request->all();

                $partner->update($data);

                return redirect()->route('profile',compact('partner'))
                                ->with('message','Profile Updated successfully');
    }

    public function changeProfileImage(Request $request, Partner $partner)
    {
                if ($image = $request->file('image')) {
                    $destinationPath = 'assets/img';
                    $profileImage = $image->getClientOriginalName();
                    $image->move($destinationPath, $profileImage);
                    $data['image'] = "$profileImage";

                    $partner->update($data);

                    
                    return redirect()->route('profile',compact('partner'))
                                    ->with('message','Profile Image Updated successfully');
                }
                
                else{
                return redirect()->route('profile', compact('partner'));
                }


    }
            
    public function changePassword(Request $request, Partner $partner)
    {
                $request->validate([
                    'old_password'     => [
                                            'required',

                                            function ($attribute, $value, $fail) {
                                                if (!Hash::check($value, auth()->user()->password)) {
                                                    $fail("The password you enter doesn't match your current password.");
                                                }
                                            },
                                        ],

                    'new_password'     => [
                                            'required',
                                            'min:6',
                                        
                                            function ($attribute, $value, $fail) {
                                                if (Hash::check($value, auth()->user()->password)) {
                                                    $fail("New Password cannot be same as your current password.");
                                                }
                                            },
                                        ],

                    'confirm_password' => 'required|same:new_password'
                                            
                                    ],
                                    [
                                        'confirm_password.same' => 'Confirm Password must be same as your new password.',
                                    ]
            );

                Partner::whereId(auth()->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return redirect()->route('profile',compact('partner'))
                                ->with('message','Password Updated successfully');
    }

    public function deleteAccount(Partner $partner)
    {     

            Session::flush();
            Auth::logout();

            
            $partner->delete();
        
            return Redirect('signin')
                    ->with('message','Account deleted successfully');
    }

//--------------------------------------------------------------------------------
//----------------------------User Management-------------------------------------
//--------------------------------------------------------------------------------

public function users(Product $product)
{
        $partners = Partner::withCount(['products'])
                            ->get()
                            ->all();
        return view('layouts.users',compact('partners'));
                               
}

function validate_newUser(Request $request)
{
        $request->validate([
            'name'             =>   'required|unique:partners',
            'email'            =>   'required|email|unique:partners',
            'password'         =>   'required|min:6',
            'confirm_password' =>   'required|same:password',
            'image'            =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role'             =>   'required|not_in:0'
        ]);

        $data = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'assets/img';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }

        Partner::create([
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
        $partner = Partner::find($id);
        return response()->json([
            'status' => 200,
            'partner' => $partner
        ]);

}

public function updateUser(Request $request)
{
        $partner_id = $request->input('partner_id');
        $partner = Partner::find($partner_id);
        
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'role'  => 'required'
            
        ]);
   
        $data = $request->all();

        $partner->update($data);
     
        return redirect()->back()->with('message','User updated successfully');

}

public function deleteUser(Partner $partner)
{
        $partner->delete();
      
        return redirect()->route('users')
                        ->with('message','User deleted successfully');
}


}
