<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Create a new ProfileController which can only be accessed by authenticated users
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the profile of the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diets = [
            0 => 'normal',
            1 => 'vegetarian',
            2 => 'vegan',
            3 => 'halal',
            4 => 'glutenfree',
            5 => 'lactosefree'
        ];        
        
        $user = Auth::user();
        $selected_diet = $user->diet;
        return view('profile',compact('user', 'selected_diet', 'diets'));
    }


    /**
     * Update the profile of the authenticated user and redirect back to the profile
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $age = $user->age;

        if ($age < 18 and $age != 0) {
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'birthdate' => 'required',
                'diet' => 'required',
                'mobile' => 'required',
                'zip' => 'required|numeric|regex:/\d{5}/',
                'guardian_firstname' => 'required',
                'guardian_lastname' => 'required',
                'guardian_email' => 'required',
                'guardian_phone' => 'required',
            ]);
        }

        else {
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'birthdate' => 'required',
                'diet' => 'required',
                'mobile' => 'required',
                'zip' => 'required|numeric|regex:/\d{5}/'
            ]);
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthdate;
        $user->diet = $request->diet;
        $user->mobile = $request->mobile;
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->zip = $request->zip;
        $user->guardian_firstname = $request->guardian_firstname;
        $user->guardian_lastname = $request->guardian_lastname;
        $user->guardian_email = $request->guardian_email;
        $user->guardian_phone = $request->guardian_phone;
        $user->complete = 1;
        $user->save();

        return redirect('profile');

    }
}
