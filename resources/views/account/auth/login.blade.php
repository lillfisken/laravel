@extends('layout.site')

@section('title')
    Logga in
    @stop

@section('content')
    <div class="inner-content">

        @include('partials.errors.basic')

        <div class="loginBox">
            <h2>Inloggning</h2>

            {!! Form::open(array('route' => 'accounts.login.post')); !!}
                <div class="bottom-padding">
                    {!! Form::label('email', 'E-mail'); !!}<br/> <!-- old value -->
                    {!! Form::email('email', Input::old('email') , ['class' => "form-input", 'placeholder' => 'e-mail' ] ); !!}
                </div>
                <div class="bottom-padding">
                    {!! Form::label('password', 'Lösenord'); !!}<br/>
                    {!! Form::password('password' , ['class' => "form-input" ] ); !!}
                </div>
                <div class="bottom-padding">
                    {!! Form::label('remember', 'Logga in vid varje besök'); !!}
                    {!! Form::checkbox('remember', 'remember', false); !!}
                </div>
                <div class="bottom-padding">
                    {!! Form::submit('Logga in', array('class' => 'btnSmall form-input')); !!}
                </div>
            {!! Form::close(); !!}
            <br/>
            {!! Form::open(['route' => 'accounts.forgotPassword', 'method' => 'get']) !!}
                <div>
                    {!! Form::submit('Glömt lösenordet', array('class' => 'btnSmall form-input')); !!}
                </div>
            {!! Form::close(); !!}
            <br/>
        </div>
        <div class="loginBox">
            <h2>Använd extern inloggning</h2>
            @foreach($phpBBforums as $phpBB)
                {!! Form::open(['route' => ['phpBB.login', $phpBB['id'] ] ]) !!}
                {!! Form::submit($phpBB['displayName'], array('class' => 'btnSmall form-input')); !!}
                {!! Form::close() !!}
            @endforeach
            {{--{!! Form::open(['url'=>'/oauth/elektronikforumet', 'method'=>'get']) !!}--}}
                {{--{!! Form::submit('Elektronikforumet', array('class' => 'btnSmall form-input')); !!}--}}
            {{--{!! Form::close() !!}--}}

            {{--{!! Form::open(['url'=>'/oauth/facebook', 'method'=>'get']) !!}--}}
                {{--{!! Form::submit('Facebook', array('class' => 'btnSmall form-input')); !!}--}}
            {{--{!! Form::close() !!}--}}

            {{--{!! Form::open(['url'=>'/oauth/facebook', 'method'=>'get']) !!}--}}
                {{--{!! Form::submit('Google', array('class' => 'btnSmall form-input')); !!}--}}
            {{--{!! Form::close() !!}--}}

            {{--{!! Form::open(['url'=>'/oauth/facebook', 'method'=>'get']) !!}--}}
                {{--{!! Form::submit('Twitter', array('class' => 'btnSmall form-input')); !!}--}}
            {{--{!! Form::close() !!}--}}

            {{--{!! Form::open(['url'=>'/oauth/facebook', 'method'=>'get']) !!}--}}
                {{--{!! Form::submit('GitHub', array('class' => 'btnSmall form-input')); !!}--}}
            {{--{!! Form::close() !!}--}}
            <br/>
        </div>
        <div class="loginBox">
            <h2>Ny användare</h2>
            {!! Form::open(array('route' => 'accounts.register', 'method'=>'get')); !!}
                {!! Form::submit('Registrera nytt konto', array('class' => 'btnSmall form-input')); !!}
            {!! Form::close(); !!}

            {!! Form::open() !!}
                {!! Form::submit('Elektronikforumet', array('class' => 'btnSmall form-input')); !!}
            {!! Form::close() !!}

            {!! Form::open(['url'=>'/oauth/register-facebook', 'method'=>'get']) !!}
                {!! Form::submit('Facebook', array('class' => 'btnSmall form-input')); !!}
            {!! Form::close(); !!}

            {!! Form::open(['url'=>'/oauth/register-google', 'method'=>'get']) !!}
                {!! Form::submit('Google', array('class' => 'btnSmall form-input')); !!}
            {!! Form::close(); !!}

            {!! Form::open(['url'=>'/oauth/register-twitter', 'method'=>'get']) !!}
                {!! Form::submit('Twitter', array('class' => 'btnSmall form-input')); !!}
            {!! Form::close(); !!}

            {!! Form::open(['url'=>'/oauth/register-github', 'method'=>'get']) !!}
                {!! Form::submit('GitHub', array('class' => 'btnSmall form-input')); !!}
            {!! Form::close(); !!}
            <br/>
        </div>
    </div>
@stop
