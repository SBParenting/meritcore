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

		/*
		[
			'id'       => 'content',
			'title'    => 'Website Content',
			'url'      => 'admin/content/pages',
			'icon'     => 'fa-list',
			'color' => 'red',

			'children' => [
				[
					'id'    => 'content.pages',
					'title' => 'Pages',
					'url'   => 'admin/content/pages',
				],

				[
					'id'    => 'content.posts',
					'title' => 'Blog Posts',
					'url'   => 'admin/content/posts',
				],

				[
					'id'    => 'content.files',
					'title' => 'Files',
					'url'   => 'admin/content/files',
				],

				[
					'id'    => 'content.images',
					'title' => 'Images',
					'url'   => 'admin/content/images',
				],

			],
		],
		*/

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

			[
			'id'       => 'children',
			'title'    => 'Children',
			'url'      => 'admin/children',
			'icon'     => 'fa-picture',

			'children' => [
				[
					'id'    => 'children.list',
					'title' => 'Manage Children',
					'url'   => 'admin/children',
				],
			],
		],

	],

	'navigation_colors' => ['danger', 'orange', 'warning', 'success', 'primary-light', 'primary', 'violet', 'danger', 'orange', 'warning', 'success', 'primary-light', 'primary', 'violet'],
);