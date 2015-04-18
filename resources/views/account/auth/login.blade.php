@extends('layout.site')

@section('content')
    <div class="inner-content">
        <h1>Inloggning</h1>

        @include('partials.errors.basic')

        {!! Form::open(array('route' => 'accounts.login.post')); !!}
            <div>
                {!! Form::label('email', 'E-mail'); !!}<br/> <!-- old value -->
                {!! Form::email('email', Input::old('email') , ['class' => "form-input", 'placeholder' => 'e-mail' ] ); !!}
            </div>
            <div>
                {!! Form::label('password', 'Lösenord'); !!}<br/>
                {!! Form::password('password' , ['class' => "form-input" ] ); !!}
            </div>
            <div>
                {!! Form::label('remember', 'Kom ihåg mig'); !!}
                {!! Form::checkbox('remember', 'remember', false); !!}
            </div>
            <div>
                {!! Form::submit('Logga in', array('class' => 'btn-right')); !!}
            </div>
            <div>
                <a href="{{ Route('accounts.forgotPassword') }}">Glömt lösenordet</a>
            </div>
            <div>
                <a href="{{ route('accounts.register') }}">Ny användare</a>
            </div>

        {!! Form::close(); !!}
    </div>
@stop
