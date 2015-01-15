<?php	

	return [

		'NAMESPACE'        => 'Content',
		'MODEL'            => "Page",
		'RESOURCE'         => "Pages",
		'ENTITY'           => "page",
		'ADMIN_VIEWPATH'   => "admin.content.pages",
		'BASEURL'          => "/admin/content/pages",
		'PERMISSION'       => "content:manage_pages",
		'NAV_LEVEL1'       => "content",
		'NAV_LEVEL2'       => "content.pages",
		'TABLE'            => "content_pages",
		'HEADING'          => "Manage Content Pages",

		'FIELDS_MIGRATION' => '$table->increments("id"); ' ."\n\t\t\t" .
							  '$table->string("title"); ' ."\n\t\t\t".
							  '$table->string("slug"); ' ."\n\t\t\t".
							  '$table->text("content"); ' ."\n\t\t\t".
							  '$table->boolean("published"); ' ."\n\t\t\t".
							  '$table->timestamps(); ' ."\n\t\t\t".
							  '$table->softDeletes(); ',

		'FIELDS_MODEL'     => "'title', 'slug', 'content', 'published'",

		'FIELD1'           => "title",
		'FIELD2'           => "slug",
		'FIELD3'           => "content",
		'FIELD4'           => "published",

		'FIELD_LABEL1'     => "Title",
		'FIELD_LABEL2'     => "Slug",
		'FIELD_LABEL3'     => "Content",
		'FIELD_LABEL4'     => "Published",

		'CREATE_RULES'     => "'title'   => 'required'," ."\n\t\t\t".
							  "'slug'    => 'required|unique:content_pages'," ."\n\t\t\t".
							  "'content' => 'required',",

		'UPDATE_RULES'     => "'title'   => 'required'," ."\n\t\t\t".
							  "'slug'    => 'required|unique:content_pages,slug,{id}'," ."\n\t\t\t".
							  "'content' => 'required',",
		
	];