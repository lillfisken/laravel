$(document).ready(function(){
    console.log('myJS');

    var $endAtInput = $('#endAtInput');
    //If element exist
    if($endAtInput.length)
    {
        if($endAtInput.val().length != 0)
        {
            // We have a previous value
            console.log('We have a previous value');
            var date = new Date($endAtInput.val());
            console.log('date: ' + date);
        }
        else
        {
            console.log('We need a new value');
            var date = new Date();
            date.setDate(date.getDate() + 7);
            console.log('date: ' + date);

        }
        //var date = new Date();
        //date.setDate(date.getDate() + 7);

        console.log('myJS');

        console.log($('#price').val());
        console.log($endAtInput.val());


        $('#endAtInput').datetimepicker({
            lang: 'se',
            mask:true,
            dayOfWeekStart: 1,
            value: date
        });
    }
});
