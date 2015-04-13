
<ul class="list-unstyled list-info top-padding">
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Name</label>
		{{ $record->name }}
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Email</label>
		{{ $record->email }}
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Address</label>
		{{ $record->province }}, {{ $record->country }}
	</li>
	<li>
		<span class="icon light fa fa-caret-right"></span>
		<label>Schools</label>
		<a href="{{ url("/admin/s/boards/info-schools/$record->id") }}" class="label label-{{ $record->schools_count > 0 ? 'info' : 'default' }} label-fixed-width">{{ $record->schools_count }}</a>
	</li>

</ul>

<div class="hr-line-dashed"></div>

<a href="{{ url("/admin/s/boards/remove/$record->id") }}" class="btn btn-danger pull-right inline js-post-remove confirm"><i class="fa fa-trash"></i> Remove School District</a>

<a href="{{ url("/admin/s/boards/update/$record->id") }}" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Update School District Information</a>