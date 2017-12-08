<?php

namespace zmdev\app\service;

use zmdev\app\base\ServiceInterface;
use zmdev\app\model\Employee;

class EmployeeService implements ServiceInterface
{
	public function findAll()
	{
		return Employee::limit(100)->get();
	}

	public function findOne(int $id)
	{
		return Employee::where('id', $id)->get();
	}
}