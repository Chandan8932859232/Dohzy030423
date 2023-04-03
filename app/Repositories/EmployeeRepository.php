<?php

namespace  App\Repositories;

use App\Models\Admin;

class EmployeeRepository implements  EmployeeRepositoryInterface{

    /*
   * get an employee by id
   * @param varchar
   */
    public function findByEmployeeId($employeeId){

        return Admin::find($employeeId);

    }

    /*
     * Get all employees
     * @return mixed
     */
    public function all(){
         return Admin::all();
    }

    /*
     * delete an employee
     * @param varchar of employee id
     */
    public function delete($employeeId){

        $employee = Admin::find($employeeId);
        $employee->delete();
    }

    /*
     * update and employee's info
     * @param varchar containing employee_id
     * @param array : containing employee data
     */
    public function update($employee_id, array $employee_data){

    }



    public function store()
    {
        $employee = new Admin;
        $employee->employee_id = request('employee_id');
        $employee->employee_first_name = request('employee_first_name');
        $employee->employee_last_name =  request('employee_last_name');
        $employee->employee_email =  request('employee_email');
        $employee->employee_password =  request('employee_password');
        $employee->employee_role =  request('employee_role');
        $employee->employee_phone_number =  request('employee_phone_number');
        $employee->employee_address =  request('employee_address');
        $employee->employee_status =  request('employee_status');
        $employee->employee_position =  request('employee_position');;

    }


    /*
   * deactivate and employee's account
   * @param varchar containing employee_id
   */
    public function deActivateEmployeeAccount($employee_id){

    }


}
