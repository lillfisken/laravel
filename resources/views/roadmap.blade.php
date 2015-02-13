@extends('layout/site')

@section('title')
	Roadmap
@stop

@section('content')
	<h1>Roadmap</h1>
	<p>Tänkt utveckling för sidan, preliminär</p>
	<hr />
	<p>
		Förhandsvisning av annonser<br />
		-> Alla fält för annons ifyllbara/uppdateringsbara <br />
		-> "Dropdown" för annonstyp, eventuellt flera olika sidor för olika typer av annons... <br />
		-> Kontaktinformation, förifylld från användarens profil <br/>
		-> Bildvisning, rätt storlek, beskärning, ej hoppande etc<br/>
		-> Lägg till orsak till avslutad annons i datljvy<br/>
		-> PM-funktion <a href="https://packagist.org/search/?tags=messaging">paket</a> <br />
		-> BB-Code <br/>
		-> Mail <br/>
		-> Möjlighet att välja kontaktsätt <br/>
		-> Förhandsvisning frågor <br/>
		-> Fixa annonsvisningmeny vid lång annons
		-> Helper för annonstyp, ändra till int i db
	</p>
	<hr />
	<p>
		Sida för användaren att ändra sina uppgifter<br />
		->  <br />
	</p>
	<hr />
	<p>
	    Extern inloggning och verifiering<br/>
		-> Koppling phpBB inloggning<br />
		-> google/facebook<br/>
	</p>
	<hr />
	<p>
    	Login<br />
    	-> Glömt lösenord <br />
    	-> Allmänna varningsmeddelanden, meddelanden etc<br/>
		-> Redirect back
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
		-> Valideringar av annonsmodel<br />
		-> Error messages in forms<br />
		-> CSS, change to SCSS using parameters for colors etc??? <br />
		-> Redirekt efter login tll önskad sida<br/>
		-> Enhetliga menyer överallt<br/>
		-> Se över obligatoriska fält i formulär (annons, registrering etc)<br/>
		-> Datumvisning, använd plugin typ Carbon???<br/>
        -> Kompatipel med IE6/7/8 etc<br/>
        -> Responsiv<br/>
	</p>
	<hr/>
	<p>
	    STOR Säkerhetsgenomgång<br/>
	    -> SQL Injection
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
	<p>
		API för externa verktyg att ladda upp och hantera annonser.<br/>
	</p>
	
@stop