<?php

namespace zmdev\app\service;

use zmdev\app\base\ServiceInterface;
use zmdev\app\model\Employee;

class EmployeeService implements ServiceInterface
{
	public function getAll()
	{
		return Employee::all();
	}
}