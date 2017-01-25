
<div class="form-group">
    {!! Form::label('User_delivery_id', 'User Delivery:') !!}
    {!! Form::select('user_delivery_id',$users,null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Status', 'Status:') !!}
    {!! Form::select('status_id',$status,null,['class'=>'form-control']) !!}
</div>



