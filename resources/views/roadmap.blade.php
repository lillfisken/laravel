@extends('layout/site')

@section('title')
	Roadmap
@stop

@section('content')
	<h1>Roadmap</h1>
	<p>Tänkt utveckling för sidan, preliminär</p>
	<hr />
	<p>
		Annonser<br />
		-> Alla fält för annons ifyllbara/uppdateringsbara (testa) ???<br />
		-> BB-Code <br/>
		-> Mail <br/>
		-> Fixa annonsvisningmeny vid lång annons<br/>
        -> Telefon, från profil om valt i annons och det finns ett registrerat telefonnr<br/>
	</p>
    <hr />
    <p>
        Login<br />
        -> Glömt lösenord <br />
        -> Allmänna varningsmeddelanden, meddelanden etc<br/>
        -> Redirect back<br/>
        <br/>
        Extern inloggning och verifiering<br/>
        -> Koppling phpBB inloggning<br />
        -> google/facebook<br/>
    </p>
	<hr />
	<p>
		Sida för användaren att ändra sina uppgifter<br />
		-> Market menu blir fel (vad menar jag?) <br />
        -> <br/>
	</p>
    <hr/>
    <p>
        Meddelanden<br/>
        -> Visning antal ny pm i menyrad, helper?<br/>
        -> Visning i inkorgen, konversationspartner, antal nya Pm etc<br/>
        -> Paginering både inbox och meddelanden<br/>
        -> Inboxen, sortera på nysate först.<br/>
        -> Ta bort markeringara för nytt inlägg i show<br/>
    </p>
	<hr />
	<p>
		STOR designöversyn<br />
		-> SEO friendly paths<br />
		-> Regex? priser 1:- istället för 1.00, ta bort decimalerna<br />
		-> Radbrytningar i text från db, spara radbrytningar etc i db<br />
		-> BBCode möjlighet ("golonka/bbcodeparser": "dev-master")<br />
		-> Fixa HTAccess för att bli av med "index.php", även market/public<br />
		-> HTML input encoding to prevent attacks<br />
		-> Sidvisning sökresultat<br />
		-> Spara kopia av annons i separat db-table vid updates<br />
		-> Visa senaste ändring/antal ändringar av annons<br />
		-> Valideringar av annonsmodel (inkluderar filtyp img vid uppladdning)<br />
		-> Error messages in forms<br />
		-> CSS, change to SCSS using parameters for colors etc??? <br />
		-> Redirekt efter login tll önskad sida<br/>
		-> Enhetliga menyer överallt<br/>
		-> Se över obligatoriska fält i formulär (annons, registrering etc)<br/>
		-> Datumvisning, använd plugin typ Carbon???<br/>
        -> Kompatipel med IE6/7/8 etc<br/>
        -> Responsiv<br/>
        -> Meddelandefält, design???<br/>
        -> Notifiering vid nytt meddelande<br/>
        -> Klocka i menyraden med servertiden...<br/>
    </p>
    <hr/>
    <p>
	    STOR Säkerhetsgenomgång<br/>
	    -> SQL Injection (testa "<script>alert('SQL')</script>"<br/>
        -> Logga ip för annons, inlägg, pm etc.<br/>
        -> Historik för annonser
	</p>
	<hr/>
	<p>
    		Fler annonstyper<br />
    		-> Auktion <br />
    		-> -> Auktionsscript <br />
			-> -> Ingen editering efter första köp/bud, bara tillägg<br/>
			-> -> +5 min vid auktion, obligatoriskt<br/>
    		-> Samköp <br />
    		-> -> ??? <br />
    		-> Tjänst/jobb <br />
    		-> -> Sökes/erbjudes/tipsas/etc <br />
			-> Auktion Eller Annons, inte båda
    	</p>
    <hr />
    <p>
        Filter/sökfunktion<br />
        -> Avancerad sökning ??? <br />
        -> Visa dolda annonser/säljare <br />
        -> Sidvisning sökresultat, antal per sida etc<br />
        -> Olika visningsalternativ<br />
        -> Möjlighet att söka med flera ord som inte behöver finnas i föld<br />
    </p>
    <hr />
	<p>
		Review-system<br />
		-> Visa samlat betyg för säljare<br />
		-> Lägg till omdöme för köpt vara/allmänt?
	</p>
	<hr/>
	<p>
		Admin sida<br />
		-> Svartlista användare<br/>
		-> Radera annonser helt (Flytta till dold db tabell)<br/>
		-> Återställa radera annonser (från dold db)<br />
	</p>
	<hr/>
	<p>
		Performance<br />
		-> Eager loading where applicable??<br />
		-> Kolla antal sql frågor vid respektive fråga
	</p>
    <hr/>
	<p>
		API för externa verktyg att ladda upp och hantera annonser.<br/>
	</p>
    <hr/>
    <p>
        Footer, Using:<br/>
        -> Laravel<br/>
        -> Intervention/Image<br/>
        -> hammer.js<br/>
    </p>
	
@stop