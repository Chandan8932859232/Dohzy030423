<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

//controller to control our language change
class LangController extends Controller
{
     //this function is used to control "multi lingualness" of the site
    //this function will see the locale and put it into the session
    //*** please not that lang (name of function) and Lang in the controller have no relationship */
    public function lang($locale)
    {
        App::setLocale($locale);     //set locale
        //storing the locale in session to get it back in the middleware
        session()->put('locale', $locale);   // put locale in session
        return redirect()->back();
    }
}
