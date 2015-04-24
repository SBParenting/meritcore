<?php

return [

	'sections' => [
		[
			'id'    => 'manage',
			'title' => 'Manage',
		],
		[
			'id'    => 'admin',
			'title' => 'Admin',
		],
		[
			'id'    => 'content',
			'title' => 'Site Content',
		],
	],

	'permissions' => [

		'manage:schools' => [
			'title'       => 'Manage Schools',
			'description' => 'Manage schools list.',
		],

		'manage:classes' => [
			'title'       => 'Manage Classes',
			'description' => 'Manage classes list.',
		],

		'admin:manage_site' => [
			'title'       => 'Admin - Manage Site',
			'description' => 'Access the backend to manage site content and settings.',
		],

		'admin:manage_users' => [
			'title'       => 'Admin - Manage Users',
			'description' => 'Access the backend to manage all users that has access to the system',
		],

		'admin:manage_roles' => [
			'title'       => 'Admin - Manage Roles & Permissions',
			'description' => 'Access the backend to manage the assignment of permissions to defined security roles.',
		],

		'school_board:manage_users' => [
			'title'       => 'Impact - Manage Users',
			'description' => 'Access the backend to manage users that has access to the schools.',
		],

		'school:manage_users' => [
			'title'       => 'School - Manage Users',
			'description' => 'Access the backend to manage users that has access to the school.',
		],

	],
];