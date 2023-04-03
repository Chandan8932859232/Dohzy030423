<?php

namespace App\Repositories;

interface EmployeeRepositoryInterface
{
    /*
     * get an employee by id
     * @param varchar
     */

     public function findByEmployeeId($employee_id);

     /*
      * Get all employees
      * @return mixed
      */

     public function all();

     /*
      * delete an employee
      * @param varchar of employee id
      */

     public function delete($employee_id);

     /*
      * update and employee's info
      * @param varchar containing employee_id
      * @param array : containing employee data
      */

     public function update($employee_id, array $employee_data);


}
