<div class="form-group">
    {!! Form::label('User', 'User:') !!}
    {!! Form::select('user_id',$users,null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Fone', 'Fone:') !!}
    {!! Form::text('fone',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Address', 'Address:') !!}
    {!! Form::text('address',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('City', 'City:') !!}
    {!! Form::text('city',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('State', 'State:') !!}
    {!! Form::text('state',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Zipcode', 'Zipcode:') !!}
    {!! Form::text('zipcode',null,['class'=>'form-control']) !!}
</div>


