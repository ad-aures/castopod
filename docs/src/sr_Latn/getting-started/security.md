---
title: Bezbednost
---

# Bezbednosni interesi

Castopod je napravljen na [CodeIgniter4](https://codeigniter.com/), PHP okviru
koji podstiče
[dobre bezbednosne prakse](https://codeigniter.com/user_guide/concepts/security.html).

Da biste maksimalno povećali bezbednost vaše instance i sprečili bilo kakav
zlonamerni napad, mi preporučujemo da ažurirate sve dozvole Castopod datoteka
nakon instalacije ili ažuriranja (da biste izbegli bilo kakvu grešku prethodne
dozvole):

- `writable/` direktorijum mora biti **readable** i **writable**.
- `public/media/` direktorijum mora biti **readable** i **writable**.
- bilo koja druga datoteka mora biti podešena na **readonly**.

Na primer, ukoliko koristite Apache ili NGINX sa Ubuntu-om možete uraditi
sledeće:

```bash
sudo chown -R root:root /path/to/castopod
sudo chown -R www-data:www-data /path/to/castopod/writable
sudo chown -R www-data:www-data /path/to/castopod/public/media
```
