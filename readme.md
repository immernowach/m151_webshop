# Webshop
*Modul 151 - Simon W. und Philipp S.*

## Setup

### Programme

Installieren Sie das folgende Programm:

[XAMPP](https://www.apachefriends.org/de/index.html)

Starten Sie in XAMPP die Module `Apache` und `MySQL`.

### Datenbank

Importieren Sie die Datenbank aus der Datei `webshop.sql` in der MySQL Datenbank mit dem folgenden Befehl:

```SQL
mysql -u root -p webshop < webshop.sql
```

### Webapp

Kopieren Sie den Inhalt des Ordners `webapp` in den Ordner `htdocs` von XAMPP.

Nun können Sie die Webapp unter `http://localhost/` aufrufen.

## Usage