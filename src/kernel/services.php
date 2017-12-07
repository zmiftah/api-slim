<?php
// Services configuration

return [
	'employee_service' => function($container) {
		return new zmdev\app\service\EmployeeService;
	}
];