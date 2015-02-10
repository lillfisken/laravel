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
		-> Uppdetering av annonser, ladda upp extra bild fungerar inte <br />
		-> "Dropdown" för annonstyp, eventuellt flera olika sidor för olika typer av annons... <br />
		-> Byt plats på pris och beskrivning, mindre förvillande. <br />
		-> Kontaktinformation, förifylld från användarens profil <br/>
		-> Aktiva annonser/totalt antalannonser<br/>
		-> Bildvisning, rätt storlek, beskärning, ej hoppande etc<br/>
		-> Lägg till "avslutad" i annonslistning om varan är avslutad<br/>
		-> Lägg till orsak till avslutad annons i datljvy<br/>
		-> PM-funktion <a href="https://packagist.org/search/?tags=messaging">paket</a> <br />
		-> Möjlighet att välja kontaktsätt<br/>
	</p>
	<hr />
	<p>
		Köp knapp<br/>
		-> Ingen editering efter första köp/bud, bara tillägg<br/>
		-> +5 min vid auktion
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
    	-> Logga in användare direkt efter registrering<br/>
    	-> Allmänna varningsmeddelanden, meddelanden etc<br/>
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
		-> Återställa radera annonser<br />
		-> Svartlista användare<br/>
		-> Radera annonser helt (Flytta till dold db tabell)
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