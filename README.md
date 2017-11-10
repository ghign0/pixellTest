PixellTest
========================

Lo scopo del test è quello di creare un cms super lite per la creazione di pagine in maniera
dinamica da un backend. Il cms dovrà essere sviluppato utilizzando symfony 3 con il
supporto di doctrine e twig, mediante la creazione di due bundle separati.
1) Il primo gestirà l inserimento modifica ed eliminazione dell entità pagina che avrà i
seguenti attributi:
* id (int autoincrement)
* title (varchar)
* slug (varchar unique)
* content (text)
* isHome (boolean)
* inMenu (boolean)
Al pannello si accederà tramite login utilizzando l Auth di symfony con il providers
in_memory.
2) Infine il secondo si occuperà di ospitare il template (un bootstrap preso dalla rete ed
integrato con twig va benissimo) e gestirà il routing caricando le pagine mediante lo slug
assegnato da backend. Il caricamento della pagina sarà composto dall header che a sua
volta caricherà il menu, un footer(molto basico) ed infine il contenuto della pagina richiesta.
Ovviamente il codice deve essere ospitato su un repository git che successivamente andrà
condiviso per la verifica del buon esito della prova.
