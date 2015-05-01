
<div class="col-md-12 closable-panel open">

    {!! Form::open(['class'=>'no-ajax search-box']) !!}
    <div class="input-group">
        <span class="input-group-btn">
            {!! Form::button('<i class="fa fa-search"></i>',['class'=>'btn btn-default', 'style'=>'padding-bottom:7px', 'type'=>'submit']) !!}
        </span>
        {!! Form::text('search',null,['class'=>'form-control']) !!}
    </div>
    {!! Form::close() !!}
    
</div>

<div class="col-md-12 closable-panel open">
	<hr />
</div>