# Webshop
*Modul 151 - Simon W. und Philipp S.*

## Programme

### Windows/MacOS/Linux Desktop

Installieren Sie das folgende Programm: 

[XAMPP](https://www.apachefriends.org/de/index.html)

Starten Sie in XAMPP die Module `Apache` und `MySQL`.

### Server

Um die Website produktiv einzusetzen können Sie die Datenbank MariaDB direkt installieren. Eine Anleitung dazu gibt es etwa hier:

[MariaDB - Ubuntu 22.04](https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-ubuntu-20-04)

Auch den Apache Server können Sie direkt installieren. Eine Anleitung dazu gibt es etwa hier:

[Apache Server - Ubuntu 22.04](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-22-04)

## Datenbank

Änder sie in der Datei `db/webshop.sql` das Passwor des Benutzers 'webshop' auf ein privates und sichers Passwort.

Importieren Sie mit dem folgenden Befehl die Datenbank aus der Datei `db/webshop.sql` in der MySQL Datenbank:

```SQL
create database webshop;
use webshop;
source db/webshop.sql;
source db/products.sql;
```

Passen Sie die Zugangsdaten in der Datei `app/universal/dbconnector.php` an.

## Webapp

Klonen Sie mit dem folgenden Befehl das Repository in einen beliebigen Ordner:

```bash
git clone https://github.com/immernowach/m151_webshop
```

Kopieren Sie den Inhalt des Ordners `app` in den Ordner `htdocs` von XAMPP.

Nun können Sie den Webshop unter [http://localhost/](http://localhost/) aufrufen.