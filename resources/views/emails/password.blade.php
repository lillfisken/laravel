<h2>Hej!</h2>

<p>
    Någon har begärt en lösenordsåterställning på ditt konto.
    Är det du? Klicka på länken för att återställa lösenordet {{ url('password/reset/'.$token) }} {{ route('accounts.resetPassword', $token) }},
    Är det inte du behöver du inte göra något men var vaksam på om någon försöker at komma åt ditt konto.
</p>

