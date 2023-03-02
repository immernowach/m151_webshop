# Webshop
*Modul 151 - Simon W. und Philipp S.*

## Programme

### Windows/MacOS/Linux Desktop

Installieren Sie das folgende Programm: [XAMPP](https://www.apachefriends.org/de/index.html)

Starten Sie in XAMPP die Module `Apache` und `MySQL`.

### Server

Um die Website produktiv einzusetzen können Sie die Datenbank MariaDB direkt installieren. Eine Anleitung dazu gibt es etwa hier:

[MariaDB - Ubuntu 22.04](https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-ubuntu-20-04)

Auch den Apache Server können Sie direkt installieren. Eine Anleitung dazu gibt es etwa hier:

[Apache Server - Ubuntu 22.04](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-22-04)

## Datenbank

Importieren Sie mit dem folgenden Befehl die Datenbank aus der Datei `db/webshop.sql` in der MySQL Datenbank:

```SQL
mysql -u root -p webshop < webshop.sql
```

## Webapp

Klonen Sie mit dem folgenden Befehl das Repository in einen beliebigen Ordner:

```bash
git clone https://github.com/immernowach/m151_webshop
```

Kopieren Sie den Inhalt des Ordners `app` in den Ordner `htdocs` von XAMPP.

Nun können Sie den Webshop unter `http://localhost/` aufrufen.
