
# Printer Resource Inventory System

!!!DEMO PROJECT!!!


## Mire való ?
Nyomtató kellékanyag nyilvántartást tudsz vezetni.

## Funkciók (bejelentkezéshez kötött):
- Nyomtató lista -> Felvett nyomtatókat lekérdezi
- Kellékanyag lista -> Lekérdezi a kellékanyagokat + az azt használó nyomtatók nevét, típusát, márkáját, a működtetéshez szükséges mennyiséget. Ha a mennyiség kissebb mint a működtetéshez szükséges akkor sárgával megjelöli azt a kellékanyagot.
- Felhasznált anyagok -> Aktuális hónapban használt anyagok, mikor melyik nyomtatóba lett cserélve. Excelbe exportálható.
- Kellékanyag bevételezés -> Bevételezni tudod a kellékanyagok, vonalkód olvasó támogatott (enter leütéssel a vonalkód mezőben következő mezőre ugrik)
- Kellékanyag kiadás -> Kellékanyagot tudsz kiadni nyomtatóra, vonalkód olvasó támogatott (enter leütéssel a vonalkód mezőben következő mezőre ugrik)
## Admin funkciók
- Nyomtató hozzáadása -> Nyomtatót tudsz hozzáadni
- Kellékanyag hozzáadása -> Kellékanyagot tudsz hozzáadni, és egyben nyomtatóhoz is tudod rendelni

## API Funkciók
 - Login Endpoint: /api/login (POST) (Mezők: username, password)
 - Bevételezés: /api/resource_in (POST) (Mezők: barcode, amount)
- Kiadás: /api/resource_out (POST) (Mezők: barcode, printer) printer=id


