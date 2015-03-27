<br /><br />
{!! Form::open(['class' => 'form-horizontal']) !!}

	<div class="form-group">
		<label class="col-md-2 control-label">School Name</label>
		<div class="col-md-4">
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'School Name']) !!}
		</div>
	</div>

	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-md-2 control-label">Email</label>
		<div class="col-md-4">
			{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Street</label>
		<div class="col-md-4">
			{!! Form::text('address_street', null, ['class' => 'form-control', 'placeholder' => 'Address Street']) !!}
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">City</label>
		<div class="col-md-4">
			{!! Form::text('address_city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Province</label>
		<div class="col-md-4">
			<div class="js-dropdown-select padded">
				{!! Form::dropdown('address_province', ['AB' => 'Alberta', 'BC' => 'British Columbia', 'MB' => 'Manitoba', 'NB' => 'New Brunswick', 'NL' => 'Newfoundland', 'NS' => 'Nova Scotia', 'NT' => 'Northwest Territories', 'NU' => 'Nunavut', 'ON' => 'Ontario', 'PE' => 'Prince Edward Island', 'QC' => 'Quebec', 'SK' => 'Saskachewan', 'YK' => 'Yukon'], null, ['class' => 'form-control', 'placeholder' => 'Province'], 'btn btn-default') !!}
			</div>
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Country</label>
		<div class="col-md-4">
			{!! Form::text('address_country', null, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-md-2 control-label">Postal Code</label>
		<div class="col-md-4">
			{!! Form::text('address_postal_code', null, ['class' => 'form-control', 'placeholder' => 'Postal Code']) !!}
		</div>
	</div>

	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<div class="col-md-10 col-sm-offset-2 text-right">
			<a href="{{ url("/admin/s/boards/info-schools/$record->id") }}" class="btn btn-default btn-lg close-button">Cancel</a>
			<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-check"></i> Save changes</button>
		</div>
	</div>

{!! Form::close() !!}
