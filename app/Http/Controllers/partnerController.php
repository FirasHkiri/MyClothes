<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class PartnerController extends Controller
{

    public function partners()
    {
        $partners = Partner::where('role', 'Partner')
                            ->get();
        return view('layouts.partners', compact('partners'));
    }
    
    public function deletePartner(Partner $partner)
    {
        $partner->delete();
      
        return redirect()->route('layouts.partners')
                        ->with('message','Partner deleted successfully');
    }

}
