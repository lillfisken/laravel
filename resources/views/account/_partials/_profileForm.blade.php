<colgroup>
    <col width="auto"/>
    <col width="100%"/>
</colgroup>
<tr>
    <td colspan="2">
        <h3>{!! Form::label('presentation', 'Presentation ') !!}</h3>
    </td>
</tr>
{!! $errors->first('presentation', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td colspan="2">
        {!! Form::textarea('presentation', null , ['class' => 'form-input okgbb'] ) !!}
    </td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
{!! $errors->first('phone1', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td>
        <h3>{!! Form::label('phone1', 'Telefonnr: ') !!}</h3>
    </td>
    <td>
        {!! Form::text('phone1', null , ['class' => 'form-input' , 'placeholder'=>'Telefonnr.'] ) !!}
    </td>
</tr>
{!! $errors->first('phoneAllowed', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td colspan="2">
        {!! Form::label('phoneAllowed', 'Visa mitt telefonnr i profilen') !!}
        {!! Form::checkbox('phoneAllowed', '1', true) !!}
    </td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
{!! $errors->first('email', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td>
        <h3>{!! Form::label('email', 'E-mail: ') !!}</h3>
    </td>
    <td>
        {!! Form::email('email', null , ['class' => 'form-input' , 'placeholder'=>'E-mail'] ) !!}
    </td>
</tr>
{!! $errors->first('emailAllowed', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td colspan="2">
        {!! Form::label('emailAllowed', 'Visa min e-mail i profilen') !!}
        {!! Form::checkbox('emailAllowed', '1', true) !!}
    </td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
<tr>
    <td colspan="2">
        <h3>Adress:</h3>
    </td>
</tr>
{!! $errors->first('name', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td>
        {!! Form::label('name', 'Namn: ') !!}
    </td>
    <td>
        {!! Form::text('name', null , ['class' => 'form-input' , 'placeholder'=>'Namn'] ) !!}
    </td>
</tr>
{!! $errors->first('street', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td>
        {!! Form::label('street', 'Gatuadress: ') !!}
    </td>
    <td>
        {!! Form::text('street', null , ['class' => 'form-input' , 'placeholder'=>'Gatuadress'] ) !!}
    </td>
</tr>
{!! $errors->first('zip', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td>
        {!! Form::label('zip', 'Postnr.') !!}
    </td>
    <td>
        {!! Form::text('zip', null , ['class' => 'form-input' , 'placeholder'=>'Postnr.'] ) !!}
    </td>
</tr>
{!! $errors->first('city', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td>
        {!! Form::label('city', 'Ort: ') !!}
    </td>
    <td>
        {!! Form::text('city', null , ['class' => 'form-input' , 'placeholder'=>'Ort'] ) !!}
    </td>
</tr>
{!! $errors->first('cityAllowed', '<tr><td colspan="2"><div class="help-block">:message</div></td></tr>') !!}
<tr>
    <td colspan="2">
        {!! Form::label('cityAllowed', 'Visa min ort i profilen (namn och gata visas inte)') !!}
        {!! Form::checkbox('cityAllowed', '1', true) !!}
    </td>
</tr>
<tr><td colspan="2"><hr/></td></tr>