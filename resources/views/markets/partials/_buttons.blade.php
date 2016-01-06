@if(isset($buttons))
    @foreach($buttons as $button)
        {!! Form::submit($button['title'], array(
            'class' => 'btn',
            'name'=>$button['name'],
            'formaction' => route($button['formactionRoute'])
            )) !!}
    @endforeach
@endif