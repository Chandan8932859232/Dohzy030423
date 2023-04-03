<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Str;


class SearchController extends Controller
{




    public function searchRequest(Request $request)
    {

        $searchTerm = $request->input('searchTerm');

        //if search term contains the word loan
       if(Str::contains($searchTerm, 'LOAN')) {

                 //search loan
         $loans = Loan::orderBy('created_at','desc')
                   ->where('id', $searchTerm)->paginate(10);

          return view('admin.loan-search-result')->with('applications', $loans);

       }

                //search user
        $users = User::orderBy('created_at','desc')
                  ->where('account_id', $searchTerm)
                  ->orWhere('firstname', $searchTerm)
                  ->orWhere('email', $searchTerm)
                  ->orWhere('lastname', $searchTerm)->paginate(10);



        return view('admin.user-search-result', compact('users'));

    }



}
