<?php

return array(

	'title' => 'CMS+ Aquanode',

	'navigation' => [

		[
			'id'     => 'dashboard',
			'title'  => 'Dashboard',
			'url'    => 'admin/dashboard',
			'icon'   => 'fa-th-large',
			'color'  => 'red',
			'access' => '*',
		],

		[
			'id'     => 'schools.boards',
			'title'  => 'School Districts',
			'url'    => 'admin/s/boards',
			'icon'   => 'fa-sitemap',
			'access' => '*',
		],

		[
			'id'     => 'schools.schools',
			'title'  => 'Schools',
			'url'    => 'admin/s/schools',
			'icon'   => 'fa-building',
			'access' => '*',
		],
		
		/*[
			'id'     => 'schools.classes',
			'title'  => 'Classes',
			'url'    => 'admin/s/classes',
			'icon'   => 'fa-child',
			'access' => '*',
		],*/

		[
			'id'     => 'users.list',
			'title'  => 'Manage Users',
			'url'    => 'admin/users',
			'icon'   => 'fa-user',
			'access' => ['admin:manage_users','school_board:manage_users'],
		],

		[
			'id'     => 'schools.surveys',
			'title'  => 'Surveys & Reports',
			'url'    => 'admin/s/surveys',
			'icon'   => 'fa-bar-chart',
			'access' => '*',
		],

		/*[
			'id'     => 'users',
			'title'  => 'Administrative Tasks',
			'url'    => 'admin/users',
			'icon'   => 'fa-lock',
			'access' => '*',

			'children' => [

				[
					'id'     => 'users.roles',
					'title'  => 'Roles & Permissions',
					'url'    => 'admin/users/roles',
					'access' => 'admin:manage_roles',
				],
			],
		],*/

	],

	'navigation_colors' => ['danger', 'orange', 'warning', 'success', 'primary-light', 'primary', 'violet', 'danger', 'orange', 'warning', 'success', 'primary-light', 'primary', 'violet'],
);