<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //get index page
    public function getIndex(){
      if(Auth::check()){
          return redirect()->route('user-dashboard');
      }
        return view('static-pages.index');
    }//end getIndex

    //get about page
    public function getAbout(){
      //below, we pass a single variable to the view blade template  using the compact method
      $title = "About Travpa";
      return view('static-pages.about', compact('title'));
    }

    //get how it works page
    public function getPricing(){
      //below, we pass a single variable to the view blade template  using the with method
      //'title' in the with method is how the variable will be called in the view blade
      //and $title is how it is defined in the Controller

      $title ="Pricing";
      return view('static-pages.pricing')->with('title', $title);
    }

     //get how it works page
     public function getHelp(){
      return view('static-pages.help');
    }


    //get index page
    public function getHome(){
      return view('static-pages.home');
    }

    //
    public function getPersonalLoansPage(){
       return view('static-pages.personal-loans');

    }

    public function getBusinessLoansPage(){
        return view('static-pages.business-loans');

     }

     public function getSavingsPage(){
         return view('static-pages.savings');
     }

}//end class
