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
		-> Aktiva annonser/totalt antalannonser
		-> Bildvisning, rätt storlek, beskärning, ej hoppande etc
	</p>
	<hr />
	<p>
		"Menyer" kopplade till respektive annons<br />
		-> Ändra <br />
		-> Radera? <br />
		-> Blockera säljare/annons <br />
		
	</p>
	<hr />
	<p>
		Sida för användaren att ändra sina uppgifter<br />
		->  <br />
	</p>
	<hr />
	<p>
	    Extern inloggning och verifiering
		-> Koppling phpBB inloggning<br />
		-> google/facebook
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
		Öppna frågor/forum samt PM-funktion<br />
	</p>
	<hr />
	<p>
    	Filter/sökfunktion<br />
    	-> -> Hela texten klickbar för att välja filter<br />
    	-> Enkel parametersök <br />
    	-> Avancerad sökning ??? <br />
    	-> Visa dolda annonser/säljare <br />
    	-> Sidvisning sökresultat, antal per sida etc<br />
    	-> Olika visningsalternativ<br />
    	-> Möjlighet att söka med flera ord som inte behöver finnas i föld<br />
    	-> Se över var standarsökning görs<br />
    </p>
	<hr />
	<p>
		STOR designöversyn<br />
		-> Radioknappar i skapa annons, koppla samman radioknapp och label<br />
		-> SEO friendly paths<br />
		-> Regex? priser 1:- istället för 1.00<br />
		-> Radbrytningar i text från db, spara radbrytningar etc i db<br />
		-> BBCode möjlighet ("golonka/bbcodeparser": "dev-master")<br />
		-> Fixa HTAccess för att bli av med "index.php", även market/public<br />
		-> HTML input encoding to prevent attacks<br />
		-> Sidvisning sökresultat<br />
		-> Radera bilder från annons???<br />
		-> Spara kopia av annons i separat db-table vid updates<br />
		-> Visa senaste ändring/antal ändringar av annons<br />
		-> Valideringar av annonsmodel<br />
		-> Error messages in forms<br />
		-> CSS, change to SCSS using parameters for colors etc??? <br />
		-> Redirekt efter login tll önskad sida
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
    		-> Samköp <br />
    		-> -> ??? <br />
    		-> Tjänst/jobb <br />
    		-> -> Sökes/erbjudes/tipsas/etc <br />
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
		-> Svartlista användare
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