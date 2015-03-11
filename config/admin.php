<?php

return array(

	'title' => 'CMS+ Aquanode',

	'navigation' => [

		[
			'id'    => 'dashboard',
			'title' => 'Dashboard',
			'url'   => 'admin/dashboard',
			'icon'  => 'fa-th-large',
			'color' => 'red',
		],

		[
			'id'       => 'users',
			'title'    => 'Users',
			'url'      => 'admin/users',
			'icon'     => 'fa-user',

			'children' => [
				[
					'id'    => 'users.list',
					'title' => 'Mangage Users',
					'url'   => 'admin/users',
				],

				[
					'id'    => 'users.roles',
					'title' => 'Roles & Permissions',
					'url'   => 'admin/users/roles',
				],
			],
		],

	],

	'navigation_colors' => ['danger', 'orange', 'warning', 'success', 'primary-light', 'primary', 'violet', 'danger', 'orange', 'warning', 'success', 'primary-light', 'primary', 'violet'],
);