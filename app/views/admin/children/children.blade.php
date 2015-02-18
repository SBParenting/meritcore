@extends('admin.layout.page')


@section('content')

<div class="view-container">
	<section class="animated fadeInUp">
		<div class="page">
			<section class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<span class="size-h2">Child Management</span>
						</div>

						<div class="col-md-6 text-right">
							<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i>Add Child</a>
						</div>

						<div class="row">
							<div class="col-md-12"><hr> </div>
						</div>

						<div class="row">
							<div style="margin:0 2%">
								<div class="col-lg-12">
									<table class="table table-striped">
										<thead>
											<tr>
												<th class="sortable" data-field="id">ID</th>
												<th class="sortable" data-field="name">Name</th>
												<th class="sortable" data-field="birthdate">Birth Date</th>
												<th class="sortable" data-field="sex">Sex</th>
												<th class="sortable" data-field="student_id">StudentID</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@if(count($children) != 0)
												@foreach($children as $child)
													<tr>
														<td>{{$child->id}}</td>
														<td>{{$child->first_name}}</td>
														<td>{{$child->birth_date}}</td>
														<td>{{$child->sex}}</td>
														<td>{{$child->student_id}}</td>
														<td><a href="#">Edit</a> &bull; <a href="#">Delete</a></td>
													</tr>
												@endforeach
											@else
												<tr>
													<td colspan="6"><p style="text-align: center;">There's no children to list.</p></td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</section>
</div>

@stop