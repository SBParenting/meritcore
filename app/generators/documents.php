<?php	

	return [

		'NAMESPACE'        => 'Content',
		'MODEL'            => "Document",
		'RESOURCE'         => "Documents",
		'ENTITY'           => "documents",
		'ADMIN_VIEWPATH'   => "admin.content.documents",
		'BASEURL'          => "/admin/content/documents",
		'PERMISSION'       => "content:manage_documents",
		'NAV_LEVEL1'       => "content",
		'NAV_LEVEL2'       => "content.documents",
		'TABLE'            => "content_documents",
		'HEADING'          => "Manage Documents",

		'FIELDS_MIGRATION' => '$table->increments("id"); ' ."\n\t\t\t" .
							  '$table->string("title"); ' ."\n\t\t\t".
							  '$table->string("slug"); ' ."\n\t\t\t".
							  '$table->string("content"); ' ."\n\t\t\t".
							  '$table->string("path"); ' ."\n\t\t\t".
							  '$table->timestamps(); ' ."\n\t\t\t".
							  '$table->softDeletes(); ',

		'FIELDS_MODEL'     => "'title', 'slug', 'content',  'path'",

		'FIELD1'           => "title",
		'FIELD2'           => "slug",
		'FIELD3'           => "path",
		'FIELD4'           => "content",

		'FIELD_LABEL1'     => "Title",
		'FIELD_LABEL2'     => "Slug",
		'FIELD_LABEL3'     => "Path",
		'FIELD_LABEL4'     => "Content",

		'CREATE_RULES'     => "'title'   => 'required'," ."\n\t\t\t".
							  "'slug'    => 'required|unique:content_documents,slug'," ."\n\t\t\t".
							  "'content' => 'required'," ."\n\t\t\t".
							  "'path' => 'required',",

		'UPDATE_RULES'     => "'title'   => 'required'," ."\n\t\t\t".
							  "'slug'    => 'required|unique:content_documents,slug,{id}'," ."\n\t\t\t".
							  "'content' => 'required'," ."\n\t\t\t".
							  "'path' => 'required',",
		
	];