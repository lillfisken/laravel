//jsfiddle: http://jsfiddle.net/h96p3mcw/6/

$(document).ready(function () {
    $('textarea.okgbb').each(function(i, val){
        bbbar($(val));
    });
});

function bbbar($target){
    //Target for text insert and button above, textarea
    //$target = $(targetId);

    var targetId = $target.attr('id');

    $target.wrap("<div class='border textContent'></div>");

    //        [blue] - <span color=blue> - Blå text
    createBtn('blue','blue',$target,targetId);
    //        [green] - <span color=green> - Grön text
    createBtn('green','green',$target,targetId);
    //        [red] - <span color=red> - Röd text
    createBtn('red','red',$target,targetId);
    //        [mark] - <mark> - Markerad
    createBtn('<mark>mark</mark>','mark',$target,targetId);
    //        [code] - <code> - Kodblock
    createBtn('code','code',$target,targetId);
    //        [url] - <url> - Länk
    createBtn('url','url',$target,targetId);
    //        [*] - <li> - Liststycke
    createBtn('li','*',$target,targetId);
    //        [ol] - <ol> - Nummrerad lista
    createBtn('ol','ol',$target,targetId);
    //        [ul] - <ul> - Punktlista
    createBtn('ul','ul',$target,targetId);
    //        [quote] - <blockquote> - citat
    createBtn('quote','quote',$target,targetId);
    //        [x2] - <sub> - nersänkt
    createBtn('X<sub>2</sub>','sub',$target,targetId);
    //        [x2] - <sup> - upphöjd
    createBtn('X<sup>2</sup>','sup',$target,targetId);
    //        [h3] - <h3> - Rubrik 3
    createBtn('h3','h3',$target,targetId);
    //        [h2] - <h2> - Rubrik 2
    createBtn('h2','h2',$target,targetId);
    //        [h1] - <h1> - Rubrik 1
    createBtn('h1','h1',$target,targetId);
    //        [del] - <del> överstruken
    createBtn('<del>del</del>','del',$target,targetId);
    //        [u] - <ins> - understruken
    createBtn('<ins>u</ins>','u',$target,targetId);
    //        [i] - <em> - kursiv
    createBtn('<em>i</em>','i',$target,targetId);
    //        [b] - <strong> - fetstil
    createBtn('<strong>b</strong>', 'b' ,$target,targetId);

    function createBtn(text, tag, $target, targetId)
    {
        $target.parent('.textContent').prepend('<button type="button" class="btnSmall ' + targetId + '" data-start="['+tag+']" data-stop="[/'+tag+']">'+text+'</button>');
    }

    $('button.' + targetId).click(function (e) {
        e.preventDefault();
        insertAtSelection($(this).data('start'), $(this).data('stop'));
    });

    function insertAtSelection(textStart, textEnd) {
        //Inspiration: http://stackoverflow.com/questions/1064089/inserting-a-text-where-cursor-is-using-javascript-jquery
        //$target.focus();

        //If target is set
        //If textStart or textEnd == null, set it to ''

        var caretStart = $target[0].selectionStart;
        var caretEnd = $target[0].selectionEnd;
        var textStartCount = textStart.length;
        var textEndCount = textEnd.length;
        var newCaretPos = caretEnd + textStartCount + textEndCount;

        //Put text in positions
        $target[0].value = $target[0].value.substring(0, caretStart) + textStart + $target[0].value.substring(caretStart, caretEnd) + textEnd + $target[0].value.substring(caretEnd, $target[0].value.length);

        //Place cursor after last input
        $target[0].setSelectionRange(newCaretPos, newCaretPos);

        //Add IE supprt if necessary
        //http://stackoverflow.com/questions/11076975/insert-text-into-textarea-at-cursor-position-javascript
    }
}