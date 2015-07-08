@extends('layout.site')

@section('content')
    <div class="inner-content">
        <h2><a href="{{ route('auction.show', ['markets'=>$auction->id]) }}"> {{ $auction->title }} </a></h2>
        <hr/>
        <p>
            @if($auction->bids)
                <table>
                    <tr class="stripe">
                        <th>Användare</th>
                        <th>Bud</th>
                        <th>Första bud</th>
                        <th>Senast uppdaterat</th>
                    </tr>
                    @foreach($auction->bids as $bid)
                        <tr class="stripe">
                            <td>{{ $bid->user->name }}</td>
                            <td>{{ preg_replace('/(\.000*)/', ':-', $bid->bid) }}</td>
                            <td>{{ $bid->created_at }}</td>
                            <td>
                                @if($bid->created_at != $bid->updated_at)
                                    {{ $bid->updated_at }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                Inga bud.
            @endif
        </p>
        <hr/>
        <p>
            <a href="{{ route('auction.show', ['markets'=>$auction->id]) }}"> Till annonsen </a>
        </p>
    </div>


@endsection