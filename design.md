Design
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

Notes
===
1. Designing Api
2. Jwt / Auth
3. Database with Eloquent