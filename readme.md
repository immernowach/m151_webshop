# Webshop
*Modul 151 - Simon W. und Philipp S.*

## Programme

Installieren Sie das folgende Programm:

[XAMPP](https://www.apachefriends.org/de/index.html)

Starten Sie in XAMPP die Module `Apache` und `MySQL`.

## Datenbank

Importieren Sie die Datenbank aus der Datei `webshop.sql` in der MySQL Datenbank mit dem folgenden Befehl:

```SQL
mysql -u root -p webshop < webshop.sql
```

## Webapp

Klonen Sie das Repository in einen beliebigen Ordner mit dem folgenden Befehl:

```bash
git clone https://github.com/immernowach/m151_webshop
```

Kopieren Sie den Inhalt des Ordners `app` in den Ordner `htdocs` von XAMPP.

Nun können Sie den Webshop unter `http://localhost/` aufrufen.