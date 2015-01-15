<?php	

	return [

		'NAMESPACE'        => 'Content',
		'MODEL'            => "ContentFile",
		'RESOURCE'         => "Files",
		'ENTITY'           => "files",
		'ADMIN_VIEWPATH'   => "admin.content.files",
		'BASEURL'          => "/admin/content/files",
		'PERMISSION'       => "content:manage_files",
		'NAV_LEVEL1'       => "content",
		'NAV_LEVEL2'       => "content.files",
		'TABLE'            => "content_files",
		'HEADING'          => "Manage Content Files",

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