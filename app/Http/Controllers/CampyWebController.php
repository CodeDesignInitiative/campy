<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\CampyWeb;

class CampyWebController extends Controller
{
    public function camp_registration(Request $request) {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'fullname' => 'required',
            'event' => 'required',
            'tos' => 'required|accepted',
        ]);
        if($validator->fails()) {
            return $this->getErrorPath($request);
        }
        $this->saveRequestToDatabase($request, 'camp_registration', [
            'mobile',
            'fullname',
            'event',
            'tos',
        ]);
        return $this->getReturnPath($request);
    }

    public function gewinnspiel(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);
        if($validator->fails()) {
            return $this->getErrorPath($request);
        }
        $this->saveRequestToDatabase($request, 'gewinnspiel', [
            'name',
            'email',
        ]);
        return $this->getReturnPath($request);
    }

    public function magazin(Request $request) {
        $validator = Validator::make($request->all(), [
            'vorname' => 'required',
            'nachname' => 'required',
            'email' => 'required',
            'anschrift' => 'required',
            'plz' => 'required',
            'ort' => 'required',
            'anzahl' => 'required',
            'reason' => 'required',
        ]);
        if($validator->fails()) {
            return $this->getErrorPath($request);
        }
        $this->saveRequestToDatabase($request, 'magazin', [
            'vorname',
            'nachname',
            'email',
            'anschrift',
            'plz',
            'ort',
            'anzahl',
            'reason',
        ]);
        return $this->getReturnPath($request);
    }

    public function kontakt(Request $request) {
        $validator = Validator::make($request->all(), [
            'vorname' => 'required',
            'nachname' => 'required',
            'email' => 'required',
            'anliegen' => 'required',
            'nachricht' => 'required',
        ]);
        if($validator->fails()) {
            return $this->getErrorPath($request);
        }
        $this->saveRequestToDatabase($request, 'kontakt', [
            'vorname',
            'nachname',
            'email',
            'anliegen',
            'nachricht',
        ]);
        return $this->getReturnPath($request);
    }

    public function interest(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'email' => 'required',
            'city' => 'required',
        ]);
        if($validator->fails()) {
            return $this->getErrorPath($request);
        }
        $this->saveRequestToDatabase($request, 'interest', [
            'vorname',
            'email',
            'city',
        ]);
        return $this->getReturnPath($request);
    }

    public function saveRequestToDatabase(Request $request, $route, $parameters) {
        $values = $request->only($parameters);
        CampyWeb::create([
            'route' => $route,
            'request' => $values,
        ]);
    }

    public function getReturnPath(Request $request) {
        $url = $request->return_path ?? 'https://code.design/';
        return redirect()->away($url);
    }

    public function getErrorPath(Request $request) {
        $url = $request->error_path ?? 'https://code.design/';
        return redirect()->away($url);
    }
}
