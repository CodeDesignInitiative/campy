<?php

namespace App\Http\Controllers;

use App\CampUser;
use App\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * The CampController manages interactions between the user and the camps
 */
class CampController extends Controller
{

    /**
     * Creates a new CampController where a user needs to be authenticated except for the camp-list
     */
    public function __construct() {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a list of registerable Camps
     */
    public function index()
    {
        $user = Auth::user();
        $camps = Camp::getRegisterableCamps();
        return view('camp.all',compact('camps', 'user'));
    }

    /**
     * Display a list of all camps the authenticated user is registered for
     */
    public function mycamps() {
        $user = Auth::user();
        $camp_user = Auth::user()->camps->sortBy('from');
        return view('camp.mycamps', compact('user', 'camp_user'));
    }

    /**
     * Display the registration form for the camp
     * If the user is already registered it will show an update form and cancellation form
     */
    public function show(Camp $camp) {
        $user = Auth::user();
        $age = $user->age;
        $campuser = $user->camps()->where('camp_id', $camp->id)->first();
        if(is_null($campuser)) {
            return view('camp.register', compact('user', 'camp', 'age'));
        }
        $camp = $campuser;
        return view('camp.update', compact('user', 'camp'));
    }

    /**
     * Register the authenticated user for the camp.
     * If the user is already registered the registration will be updated
     */
    public function register(Request $request, Camp $camp) {
        $campuser_exists = CampUser::where('user_id', Auth::id())->where('camp_id', $camp->id)->exists();
        if($campuser_exists) {
            return redirect('/mycamps');
        }
        $this->validate($request, [
            'tos' => 'required',
            'consent' => 'required',
            'laptop' => 'required',
            'contribution' => 'required'
        ]);

        $tos = $request->tos;
        $consent = $request->consent;
        $laptop = $request->laptop;
        $contribution = $request->contribution;
        $comment = $request->comment;

        if ($camp->free_spots < 1) {
            $status = 'waiting';
        }
        else {
            $status = 'registered';
        }

        Auth::user()->camps()->syncWithoutDetaching([$camp->id => [
            'status' => $status,
            'consent' => $consent,
            'tos' => $tos,
            'laptop' => $laptop,
            'contribution' => $contribution,
            'comment' => $comment,
        ]]);

        return redirect('/mycamps');
    }

    /**
     * Updates the registration of the authenticated user for the camp
     * If the user is not registered yet the registration will be created
     */
    public function update(Request $request, Camp $camp) {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'laptop' => 'required',
            'contribution' => 'required'
        ]);


        $user = Auth::user();
        $camp_registered = $request->camp;
        $laptop = $request->laptop;
        $contribution = $request->contribution;
        $comment = $request->comment;
        $reason = $request->reason_for_cancellation;

        if (isset($reason)){
            $status = 'cancelled';

            $user->camps()->syncWithoutDetaching([$camp_registered => [
                'status' => $status,
                'comment' => $comment,
                'reason_for_cancellation' => $reason
            ]]);
        }

        else {
            $user->camps()->syncWithoutDetaching([$camp_registered => [
                'contribution' => $contribution,
                'laptop' => $laptop,
                'comment' => $comment
            ]]);
        }

        return redirect('/mycamps');
    }

}
