@extends('layout/site')

@section('content')
	@include('partials.errors.basic')

	{!! Form::open(array('url' => '/auth/register')); !!}
	    <div>
            {!! Form::label('name', 'Namn'); !!}<br/>
            {!! Form::text('name', null , ['class' => 'form-input', 'placeholder'=>'Namn', 'value'=>'{{ old("name") }}' ] ); !!}
        </div>
        <div>
            {!! Form::label('email', 'E-mail'); !!}<br/> <!-- old value -->
            {!! Form::email('email', null , ['class' => "form-input", 'placeholder'=>'Email' ] ); !!}
        </div>
        <div>
            {!! Form::label('password', 'Lösenord'); !!}<br/>
            {!! Form::password('password', null , ['class' => "form-input" ] ); !!}
        </div>
        <div>
            {!! Form::label('password_confirmation', 'Upprepa lösenord'); !!}<br/>
            {!! Form::password('password_confirmation', null , ['class' => 'form-input', 'placeholder'=>'Confirm Password' ] ); !!}
        </div>
        <div>
    		{!! Form::submit('Skapa konto', array('class' => 'btn-right')); !!}
        </div>

    {!! Form::close(); !!}
@stop
