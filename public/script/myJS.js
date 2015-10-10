$(document).ready(function(){

        var date = new Date();
        date.setDate(date.getDate() + 7);

        $('#endAtInput').datetimepicker({
            lang: 'se',
            mask:true,
            dayOfWeekStart: 1,
            value: date
        });

    }
);
