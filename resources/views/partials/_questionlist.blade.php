@if(isset($market))
    <div id="market-forum" class="layout">
        <h1 class="market-title" >Frågor</h1>

        {{--@if( $market->marketQuestions() != null )--}}
        @if( $market->marketQuestions()->count() > 0 )

        {{--List questions and answers--}}
        <?php $count = 1; ?>

            @foreach($market->marketQuestions as $question)
                <div class="list-row list-underline @if($count == 1)row-dark <?php $count = 0; ?> @else	<?php $count = 1; ?> @endif ">
                    <div>
                        <h4 class="inline">{{ $question->user->username or 'null' }}</h4> <small class="align-right">{{ $question->created_at }}</small>
                    </div>
                    <div>
                        {{ $question->message }}
                    </div>
                </div>

            @endforeach
        @else
            <h2>Inga frågor ställda än </h2>
            <p>Var först med en fråga till säljaren!</p>
        @endif

        @if($market->preview)
            <p>Förhandsgranskning</p>
        @elseif(Auth::check())
            {{--Form for sending question/answers--}}
            {!! Form::open(array('route' => 'markets.question')) !!}
            {!! Form::hidden('market', $market->id) !!}
            {!! Form::textarea('message', null , ['class' => "form-input" ] ) !!}
            <br/>
            {!! Form::submit('Skicka', array('class' => 'btn-right')); !!}
            {!! Form::submit('Förhandsgranska', array('class' => 'btn-right')); !!}
            {!! Form::close() !!}
        @else
            <a href="{{ route('accounts.login') }}"><h3> Logga in för att skriva en kommentar.</h3></a>
        @endif

    </div>
@endif