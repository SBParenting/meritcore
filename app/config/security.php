<?php

return [

	'permissions_sections' => [
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
			'description' => 'Access the CMS+ backend to manage site content and settings.',
		],

		'system:manage_users' => [
			'title'       => 'Manage Users',
			'description' => 'Manage all users that has access to the system',
		],

		'system:manage_roles' => [
			'title'       => 'Manage Roles & Permissions',
			'description' => 'Manage the assignment of permissions to defined security roles.',
		],

		'content:manage_content' => [
			'title'       => 'Manage Content',
			'description' => 'Manage the website public content.',
		],

		'content:manage_pages' => [
			'title'       => 'Manage Pages',
			'description' => 'Manage the website public content.',
		],

		'content:manage_images' => [
			'title'       => 'Manage Images',
			'description' => 'Manage the images content.',
		],

		'content:manage_posts' => [
			'title'       => 'Manage Posts',
			'description' => 'Manage the posts content.',
		],

		'content:manage_files' => [
			'title'       => 'Manage Files',
			'description' => 'Manage the files content.',
		],
	],
];