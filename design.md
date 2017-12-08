Api Design
===

Route 													 	Purpose
----------------------------------------------------------------------------
GET /employee 									| Lists all users, optionally filtered by search parameters
GET /employee/{id} 							| Returns a single user
PUT /employee/{id} 							| 
DELETE /employee/{id} 					| Deletes a user
PUT /employee/{id}/image 				| Stores a new profile image for a user
GET /employee/{id}/image 				| Retrieves the user's profile image
DELETE /employee/{id}/image 		| Deletes a profile image

Class Design
===

base
	ResponderInterface
	ServiceInterface
model
	Employee
responder
	EmployeeResponder
service
	EmployeeService

Notes
===
1. Designing Api
2. Jwt / Auth
3. Database with Eloquent
4. Action-Domain-Responder
5. Add Migration

Links
===
http://pmjones.io/adr/
https://www.slimframework.com/docs/cookbook/action-domain-responder.html
https://www.slimframework.com/2013/03/21/slim-and-laravel-eloquent-orm.html
https://fractal.thephpleague.com/resources/
https://github.com/afshinpersian/afshlim_framework
https://github.com/luchisds/api-um
https://github.com/zkavtaskin/Domain-Driven-Design-Example