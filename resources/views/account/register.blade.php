@extends('layout/site')

@section('title')
    Ny användare
@stop

@section('content')
	@include('partials.errors.basic')

	{!! Form::open(['route' => 'accounts.register.post']); !!}
	    <div>
            {!! Form::label('name', 'Namn'); !!}<br/>
            {!! Form::text('name', null , ['class' => 'form-input', 'placeholder'=>'Namn', 'value'=>'{{ old("name") }}' ] ); !!}
        </div>
        <div>
            {!! Form::label('email', 'E-mail'); !!}<br/> <!-- old value -->
            {!! Form::email('email', null , ['class' => "form-input", 'placeholder'=>'Email' ] ); !!}
        </div>
        <div>
            {!! Form::label('username', 'Användarnamn'); !!}<br/> <!-- old value -->
            {!! Form::text('username', null , ['class' => "form-input", 'placeholder'=>'Användarnamn' ] ); !!}
        </div>
        <div>
            {!! Form::label('address', 'Adress'); !!}<br/> <!-- old value -->
            {!! Form::text('address', null , ['class' => "form-input", 'placeholder'=>'Adress' ] ); !!}
        </div>
        <div>
            {!! Form::label('zipcode', 'Postnr'); !!}<br/> <!-- old value -->
            {!! Form::text('zipcode', null , ['class' => "form-input", 'placeholder'=>'Postnr' ] ); !!}
        </div>
        <div>
            {!! Form::label('city', 'Ort'); !!}<br/> <!-- old value -->
            {!! Form::text('city', null , ['class' => "form-input", 'placeholder'=>'Ort' ] ); !!}
        </div>
        <div>
            {!! Form::label('phone1', 'Telefonnr*'); !!}<br/> <!-- old value -->
            {!! Form::text('phone1', null , ['class' => "form-input", 'placeholder'=>'Telefonnr' ] ); !!}
        </div>
        <div>
            {!! Form::label('phone2', 'Alternativt telefonnr'); !!}<br/> <!-- old value -->
            {!! Form::text('phone2', null , ['class' => "form-input", 'placeholder'=>'Alternativt telefonnr' ] ); !!}
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
