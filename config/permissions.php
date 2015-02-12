<?php

return [

	'sections' => [
		[
			'id'    => 'system',
			'title' => 'System',
		],
		[
			'id'    => 'content',
			'title' => 'Site Content',
		],
	],

	'permissions' => [

		'system:manage_site' => [
			'title'       => 'Manage Site',
			'description' => 'Access the backend to manage site content and settings.',
		],

		'system:manage_users' => [
			'title'       => 'Manage Users',
			'description' => 'Manage all users that has access to the system',
		],

		'system:manage_roles' => [
			'title'       => 'Manage Roles & Permissions',
			'description' => 'Manage the assignment of permissions to defined security roles.',
		],

	],
];