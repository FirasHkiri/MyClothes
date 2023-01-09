<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class partnerController extends Controller
{
    public function index()
    {
        $partners = User::where('role', 'Partner')
                            ->get();
        return view('layouts.partners', compact('partners'));
    }
    
    public function profile(User $user)
    {
        return view('layouts.profile',compact('partner'));
    }

    public function updateProfile(Request $request, User $user)
    {


        $request->validate([
            'name'         =>   [   
                                    'required',
                                    Rule::unique('users')->ignore($user->id),
                                ],
            'email'        =>   [
                                    'required',
                                    'email',
                                    Rule::unique('users')->ignore($user->id),
                                ],

        ]);

            $data = $request->all();

            $user->update($data);

            return redirect()->route('profile',compact('user'))
                            ->with('message','Profile Updated successfully');
    }

    public function changeProfileImage(Request $request, User $user)
    {
            if ($image = $request->file('image')) {
                $destinationPath = 'assets/img';
                $profileImage = $image->getClientOriginalName();
                $image->move($destinationPath, $profileImage);
                $data['image'] = "$profileImage";

                $user->update($data);

                
                return redirect()->route('profile',compact('user'))
                                 ->with('message','Profile Image Updated successfully');
            }
            
            else{
            return redirect()->route('profile', compact('user'));
            }


    }
        
    public function changePassword(Request $request, User $user)
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

                User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->route('profile',compact('user'))
                             ->with('message','Password Updated successfully');
    }

    public function delete(User $user)
    {
        $user->delete();
      
        return redirect()->route('layouts.partners')
                        ->with('message','Partner deleted successfully');
    }

    public function deleteAccount(User $user)
    {     

        Session::flush();
        Auth::logout();

        
        $user->delete();
      
        return Redirect('signin')
                ->with('message','Account deleted successfully');
    }
}
