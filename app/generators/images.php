<?php	

	return [

		'NAMESPACE'        => 'Content',
		'MODEL'            => "Image",
		'RESOURCE'         => "Images",
		'ENTITY'           => "images",
		'ADMIN_VIEWPATH'   => "admin.content.images",
		'BASEURL'          => "/admin/content/images",
		'PERMISSION'       => "content:manage_images",
		'NAV_LEVEL1'       => "content",
		'NAV_LEVEL2'       => "content.images",
		'TABLE'            => "content_images",
		'HEADING'          => "Manage Content Images",

		'FIELDS_MIGRATION' => '$table->increments("id"); ' ."\n\t\t\t" .
							  '$table->string("title"); ' ."\n\t\t\t".
							  '$table->string("path"); ' ."\n\t\t\t".
							  '$table->timestamps(); ' ."\n\t\t\t".
							  '$table->softDeletes(); ',

		'FIELDS_MODEL'     => "'title', 'path'",

		'FIELD1'           => "title",
		'FIELD2'           => "path",
		'FIELD3'           => "",
		'FIELD4'           => "",

		'FIELD_LABEL1'     => "Title",
		'FIELD_LABEL2'     => "Path",
		'FIELD_LABEL3'     => "",
		'FIELD_LABEL4'     => "",

		'CREATE_RULES'     => "'title'   => 'required'," ."\n\t\t\t".
							  "'path' => 'required',",

		'UPDATE_RULES'     => "'title'   => 'required'," ."\n\t\t\t".
							  "'path' => 'required',",
		
	];