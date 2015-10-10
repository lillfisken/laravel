/**
 * Created by Oskar on 2015-10-08.
 */

$(document).ready(function(){
    // Select auction time
    // Get data- (id, endtime as unix etc...)
    // Get new time, if new update time and data-
    console.log('time-unix: ' + $('#time').data('unix'));
    console.log('time: ' + $('#time').text());

    okUpdateClock();
    okUpdateAuctionTime();

});

function okUpdateClock(){
    // Update the clock on page every minute

    setInterval(function() {
        $timeUnix = $('#time').data('unix');
        $date = new Date($timeUnix * 1000);

        $('#time').text(('0' + $date.getHours()).slice(-2) + ':' + ('0' + $date.getMinutes()).slice(-2));
        $('#time').data('unix', ($timeUnix * 1) + 60);
    }, 60*1000);

}

function okUpdateAuctionTime(){
    if( $('#auction-end').length ) {
        setInterval(function () {
            auctionEnd = $('#auction-end');
            endAt = auctionEnd.data('unix');
            currentTime = $('#time').data('unix');
            difference = endAt - currentTime;

            //if (difference < 10 * 60) //If auction ends in 10 minutes, check for new time and update
            if (true) //If auction ends in 10 minutes, check for new time and update
            {

                url = auctionEnd.data('url');
                $.getJSON(url, function (data) {
                    newEndAt = data['end_at'];

                    if (newEndAt != null && newEndAt > endAt) {
                        newDate = new Date(newEndAt * 1000);

                        auctionEnd.text(
                            newDate.getFullYear() + '-' +
                            ('0' + (newDate.getMonth() + 1)).slice(-2) + '-' +
                            ('0' + newDate.getDate()).slice(-2) + ' ' +
                            ('0' + newDate.getHours()).slice(-2) + ':' +
                            ('0' + newDate.getMinutes()).slice(-2));
                        auctionEnd.data('unix', newEndAt);
                    }

                });
            }
        }, 60 * 1000);
    }
}