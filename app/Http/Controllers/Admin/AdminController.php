<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    private $employeeRepository;



    public  function __construct(EmployeeRepository $employeeRepository){

       $this->employeeRepository = $employeeRepository;

        $this->middleware('auth:admin');
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function index(){
        $employees = $this->employeeRepository->all();
        return $employees;
    }

    public function getAdminIndex(){
        return view('admin.index');
    }

    public function show($employeeId)
    {
        return  $this->employeeRepository->findByEmployeeId($employeeId);
    }

    public  function destroy($employeeId){
        $this->employeeRepository->delete($employeeId);
        return redirect('/admin/employees/');

    }

    /** TODO */
    public function update($employeeId){
        $employee =Admin::find($employeeId);
    }



}
