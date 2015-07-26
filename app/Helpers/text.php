<?php namespace market\helper;

use Chromabits\Purifier\Contracts\Purifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\App;
use JBBCode;

//require_once '/vendor/jbbcode/jbbcode/JBBCode/Parser.php';

class text
{
    public static function purify($string, $purifier)
    {
        $string = $purifier->clean($string, 'custom');

        return $string;
    }

    public static function purifyMarketInput($input, $purifier)
    {
        if(isset($input['description']))
        {
            $input['description'] = self::purify($input['description'], $purifier);
        }

        if(isset($input['title']))
        {
            $input['title'] = self::purify($input['title'], $purifier);
        }

        if(isset($input['extra_price_info']))
        {
            $input['extra_price_info'] = self::purify($input['extra_price_info'], $purifier);
        }

        return $input;
    }

    /**
     * @param $input
     * @param Purifier $purifier
     * @return mixed
     */
    public static function purifyQuestionInput($input, $purifier)
    {
        if(isset($input['message']))
        {
            $input['message'] = self::purify($input['message'], $purifier);
        }

        return $input;
    }

    public static function purifyPassword($password)
    {
        return $password;
    }

    public static function marketFromBbToHtml($input)
    {
        debug::logConsole('marketFromBbToHtml');
        $input['description'] = self::bbCodeToHtml($input['description']);
        $input['extra_price_info'] = self::bbCodeToHtml($input['extra_price_info']);

        return $input;
    }

    public static function marketFromHtmlToBB($input)
    {
        debug::logConsole('marketFromHtmlToBB');
        $input['description'] = self::htmlToBbCode($input['description']);
        $input['extra_price_info'] = self::htmlToBbCode($input['extra_price_info']);

        return $input;
    }

    public static function questionFromBBToHTML($input){
        $input['message'] = self::bbCodeToHtml($input['message']);

        return $input;
    }

    public static function questionFromHTMLToBB($input){
        $input['message'] = self::htmlToBbCode($input['message']);

        return $input;
    }

    public static function bbCodeToHtml($content)
    {
        //TODO: Build new bb -> html -> bb parser with php script
        debug::logConsole('text -> bbCodeToHtml -----------------------');

        /*[b] - <strong> - fetstil
        [i] - <em> - kursiv
        [u] - <ins> - understruken
        [del] - <del> överstruken
        [h1] - <h1> - Rubrik 1
        [h2] - <h2> - Rubrik 2
        [h3] - <h3> - Rubrik 3
        [x2] - <sup> - upphöjd
        [x2] - <sub> - nersänkt
        [quote] - <blockquote> - citat
        [ul] - <ul> - Punktlista
        [ol] - <ol> - Nummrerad lista
        [*] - <li> - Liststycke
        [url] - <url> - Länk
        [code] - <code> - Kodblock
        [mark] - <mark> - Markerad
        [red] - <span color=red> - Röd text
        [green] - <span color=green> - Grön text
        [blue] - <span color=blue> - Blå text*/

        $search = [
//        [b] - <strong> - fetstil
            '/(\[b\])((.|\n)*?)(\[\/b\])/',
////        [i] - <em> - kursiv
            '/(\[i\])((.|\n)*?)(\[\/i\])/',
//        [u] - <ins> - understruken
            '/(\[u\])((.|\n)*?)(\[\/u\])/',
//        [del] - <del> överstruken
            '/(\[del\])((.|\n)*?)(\[\/del\])/',
//        [h1] - <h1> - Rubrik 1
            '/(\[h1\])((.|\n)*?)(\[\/h1\])/',
//        [h2] - <h2> - Rubrik 2
            '/(\[h2\])((.|\n)*?)(\[\/h2\])/',
//        [h3] - <h3> - Rubrik 3
            '/(\[h3\])((.|\n)*?)(\[\/h3\])/',
//        [x2] - <sup> - upphöjd
            '/(\[sup\])((.|\n)*?)(\[\/sup\])/',
//        [x2] - <sub> - nersänkt
            '/(\[sub\])((.|\n)*?)(\[\/sub\])/',
////        [quote] - <blockquote> - citat
//            '/(\[quote\])((.|\n)*?)(\[\/quote\])/',
//        [ul] - <ul> - Punktlista
            '/(\[ul\])((.|\n)*?)(\[\/ul\])/',
//        [ol] - <ol> - Nummrerad lista
            '/(\[ol\])((.|\n)*?)(\[\/ol\])/',
//        [*] - <li> - Liststycke
            '/(\[\*\])((.|\n)*?)(\[\/\*\])/',
//        [url] - <url> - Länk
            '/(\[url=)((.|\n)*?)(\])(.*?)(\[\/url\])/',
            '/(\[url\])((.|\n)*?)(\[\/url\])/',
//        [code] - <code> - Kodblock
            '/(\[code\])((.|\n)*?)(\[\/code\])/',
////        [mark] - <mark> - Markerad
//            '/(\[mark\])(.*?)(\[\/mark\])/',
//        [red] - <span color=red> - Röd text
            '/(\[red\])((.|\n)*?)(\[\/red\])/',
//        [green] - <span color=green> - Grön text
            '/(\[green\])((.|\n)*?)(\[\/green\])/',
//        [blue] - <span color=blue> - Blå text
            '/(\[blue\])((.|\n)*?)(\[\/blue\])/'
        ];
//
        $replace = [
//        [b] - <strong> - fetstil
            '<strong>$2</strong>',
//        [i] - <em> - kursiv
            '<em>$2</em>',
//        [u] - <ins> - understruken
            '<ins>$2</ins>',
//        [del] - <del> överstruken
            '<del>$2</del>',
//        [h1] - <h1> - Rubrik 1
            '<h1>$2</h1>',
//        [h2] - <h2> - Rubrik 2
            '<h2>$2</h2>',
//        [h3] - <h3> - Rubrik 3
            '<h3>$2</h3>',
//        [x2] - <sup> - upphöjd
            '<sup>$2</sup>',
//        [x2] - <sub> - nersänkt
            '<sub>$2</sub>',
////        [quote] - <blockquote> - citat
//            '<blockquote>$2</blockquote>',
//        [ul] - <ul> - Punktlista
            '<ul>$2</ul>',
//        [ol] - <ol> - Nummrerad lista
            '<ol>$2</ol>',
//        [*] - <li> - Liststycke
            '<li>$2</li>',
//        [url] - <url> - Länk
            '<a href="$2" target="_blank">$5</a>',
            '<a href="$2" target="_blank">$2</a>',
//        [code] - <code> - Kodblock
            '<code>$2</code>',
//        [mark] - <mark> - Markerad
            //TODO:Add support for mark in purifier
//            '<mark>$2</mark>',
            //TODO:Add text colors
//        [red] - <span color=red> - Röd text
            '<span class="red">$2</span>',
//        [green] - <span color=green> - Grön text
            '<span class="green">$2</span>',
//        [blue] - <span color=blue> - Blå text
            '<span class="blue">$2</span>'
        ];
//
        debug::logConsole('Search: ' . count($search) . ' ,Replace: ' . count($replace));
//        dd(preg_replace($search, $replace, $content),$search,$replace);
//
        return preg_replace($search, $replace, $content);
    }

    public static function htmlToBbCode($content)
    {
        debug::logConsole('text -> htmlToBbCode -----------------------');
//        debug::logConsole('content: ' . $content);
//        dd($content);

        $search = [
//            [b] - <strong> - fetstil
            '/(\<strong\>)((.|\n)*?)(\<\/strong\>)/',
//            [i] - <em> - kursiv
            '/(\<em\>)((.|\n)*?)(\<\/em\>)/',
//            [u] - <ins> - understruken
            '/(\<ins\>)((.|\n)*?)(\<\/ins\>)/',
//            [del] - <del> överstruken
            '/(\<del\>)((.|\n)*?)(\<\/del\>)/',
//            [h1] - <h1> - Rubrik 1
            '/(\<h1\>)((.|\n)*?)(\<\/h1\>)/',
//            [h2] - <h2> - Rubrik 2
            '/(\<h2\>)((.|\n)*?)(\<\/h2\>)/',
//            [h3] - <h3> - Rubrik 3
            '/(\<h3\>)((.|\n)*?)(\<\/h3\>)/',
//            [x2] - <sup> - upphöjd
            '/(\<sup\>)((.|\n)*?)(\<\/sup\>)/',
//            [x2] - <sub> - nersänkt
            '/(\<sub\>)((.|\n)*?)(\<\/sub\>)/',
////            [quote] - <blockquote> - citat
//            '/(\<blockquote\>)((.|\n)*?)(\<\/blockquote\>)/',
//            [ul] - <ul> - Punktlista
            '/(\<ul\>)((.|\n)*?)(\<\/ul\>)/',
//            [ol] - <ol> - Nummrerad lista
            '/(\<ol\>)((.|\n)*?)(\<\/ol\>)/',
//            [*] - <li> - Liststycke
            '/(\<li\>)((.|\n)*?)(\<\/li\>)/',
//            [url] - <url> - Länk
            '/(\<a\shref\=\")((.|\n)*?)(\"\>)((.|\n)*?)(\<\/a\>)/',
//            [code] - <code> - Kodblock
            '/(\<code\>)((.|\n)*?)(\<\/code\>)/',
//            [mark] - <mark> - Markerad/
//            [red] - <span color=red> - Röd text
            '/(\<span\sclass\=\"red\"\>)((.|\n)*?)(\<\/span\>)/',
//            [green] - <span color=green> - Grön text
            '/(\<span\sclass\=\"green\"\>)((.|\n)*?)(\<\/span\>)/',
//            [blue] - <span color=blue> - Blå text
            '/(\<span\sclass\=\"blue\"\>)((.|\n)*?)(\<\/span\>)/',
        ];
//
        $replace = [
//        [b] - <strong> - fetstil
            '[b]$2[/b]',
//        [i] - <em> - kursiv
            '[i]$2[/i]',
//        [u] - <ins> - understruken
            '[u]$2[/u]',
//        [del] - <del> överstruken
            '[del]$2[/del]',
//        [h1] - <h1> - Rubrik 1
            '[h1]$2[/h1]',
//        [h2] - <h2> - Rubrik 2
            '[h2]$2[/h2]',
//        [h3] - <h3> - Rubrik 3
            '[h3]$2[/h3]',
//        [x2] - <sup> - upphöjd
            '[sup]$2[/sup]',
//        [x2] - <sub> - nersänkt
            '[sub]$2[/sub]',
////        [quote] - <blockquote> - citat
//            '[quote]$2[/quote]',
//        [ul] - <ul> - Punktlista
            '[ul]$2[/ul]',
//        [ol] - <ol> - Nummrerad lista
            '[ol]$2[/ol]',
//        [*] - <li> - Liststycke
            '[*]$2[/*]',
//        [url] - <url> - Länk
            '[url=$2]$5[/url]',
//        [code] - <code> - Kodblock
            '[code]$2[/code]',
//        [mark] - <mark> - Markerad/
//        [red] - <span color=red> - Röd text
            '[red]$2[/red]',
//        [green] - <span color=green> - Grön text
            '[green]$2[/green]',
//        [blue] - <span color=blue> - Blå text
            '[blue]$2[/blue]'
        ];

        debug::logConsole('Search length: ' . count($search) . ', Replace length: ' . count($replace));
//
//        dd($search, $replace, $content, preg_replace($search, $replace, $content));
        return preg_replace($search, $replace, $content);
    }
}