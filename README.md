# Store-Secondhand-PHP
Jag har valt att bygga en webbtjänst i PHP för att hantera säljare och plagg. 

Jag har använt objektorienterad programmering (OOP) för att strukturera min kod och följa bästa praxis. För att organisera min kod enligt MVC-mönstret har jag skapat separata klasser för modellen och vyn. Klassen "MickelStoreModel" ansvarar för att kommunicera med databasen och utföra olika arbete, medan klassen "MickelStoreView" är ansvarig för att rendera HTML-sidor och presentera data för användaren. 

För att kommunicera med databasen har jag använt PDO med prepared statements, vilket ger säkerhet mot SQL-injektion och underlättar databasinteraktionen. 

Jag har designat och implementerat en databasstruktur med två tabeller: "sellers" och "clothes". Tabellen "sellers" innehåller information om varje säljare, medan tabellen "clothes" innehåller information om varje plagg.
