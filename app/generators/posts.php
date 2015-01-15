<?php	

	return [

		'NAMESPACE'        => 'Content',
		'MODEL'            => "Post",
		'RESOURCE'         => "Posts",
		'ENTITY'           => "post",
		'ADMIN_VIEWPATH'   => "admin.content.posts",
		'BASEURL'          => "/admin/content/posts",
		'PERMISSION'       => "content:manage_posts",
		'NAV_LEVEL1'       => "content",
		'NAV_LEVEL2'       => "content.posts",
		'TABLE'            => "content_posts",
		'HEADING'          => "Manage Content Posts",

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
							  "'slug'    => 'required|unique:content_posts'," ."\n\t\t\t".
							  "'content' => 'required',",

		'UPDATE_RULES'     => "'title'   => 'required'," ."\n\t\t\t".
							  "'slug'    => 'required|unique:content_posts,slug,{id}'," ."\n\t\t\t".
							  "'content' => 'required',",
		
	];