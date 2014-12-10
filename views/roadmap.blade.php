@extends('layout/site')

@section('title')
	Roadmap
@stop

@section('content')
	<h1>Roadmap</h1>
	<p>Tänkt utveckling för sidan, preliminär</p>
	<hr />
	<p>
		Login<br />
		-> Koppla egen inloggning till sidan <br />
		-> Skapa konto <br />
		-> Glömt lösenord <br />
		-> Logga ut <br />
	</p>
	<hr />
	<p>
		Koppla samman annonser och användare<br />
		->  <br />
	</p>
	<hr />
	<p>
		Förhandsvisning av annonser<br />
		-> Alla fält för annons ifyllbara/uppdateringsbara <br />
		-> Växling, visning av alla bilder<br />
	</p>
	<hr />
	<p>
		"Menyer" kopplade till respektive annons<br />
		-> Ändra <br />
		-> Radera <br />
		-> Blockera säljare/annons <br />
		
	</p>
	<hr />
	<p>
		Sida för användaren att ändra sina uppgifter<br />
		->  <br />
	</p>
	<hr />
	<p>
		Koppling phpBB inloggning<br />
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
	<p>
		Admin sida<br />
		-> Återställa radera annonser<br />
		-> Svartlista användare
	</p>
	
@stop