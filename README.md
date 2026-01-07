# task-manager
A simple PHP &amp; MySQL task manager with login, deadlines and task status.

Projectomschrijving
Ik heb een task manager website gemaakt waarin gebruikers hun eigen taken kunnen bijhouden. De website is bedoeld voor mensen die overzicht willen houden in hun taken en deadlines. Gebruikers kunnen inloggen en zien alleen hun eigen taken. Het project lost het probleem op dat taken vaak vergeten worden of onoverzichtelijk zijn.

Functionaliteiten
Gebruikers kunnen een account aanmaken en inloggen. Elke gebruiker ziet zijn eigen taken, en kan die van de andere niet zien of wijzigen. Ze kunnen taken toevoegen met een deadline. Taken kunnen worden bewerkt en verwijderd. Een taak kan worden gemarkeerd als gedaan of niet gedaan. Taken worden automatisch gesorteerd op deadline. Gebruikers kunnen uitloggen.

Installatie-instructies
Om dit project lokaal te draaien heb je een lokale server nodig zoals XAMPP. Download of clone de repository en plaats deze in de htdocs map. Maak in phpMyAdmin een nieuwe database aan en importeer het meegeleverde .sql bestand. In het bestand DB.php moeten de juiste databasegegevens staan. Start Apache en MySQL en open het project via http://localhost/ gevolgd door de projectmap.

Technieken die ik heb gebruikt
Voor dit project heb ik PHP gebruikt voor de backend, MySQL voor de database, HTML voor de structuur en CSS voor de styling. De databaseverbinding is gemaakt met PDO.
