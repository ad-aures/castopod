---
title: Säkerhet
---

# Säkerhetsfrågor

Castopod är byggt ovanpå [CodeIgniter4](https://codeigniter.com/), ett PHP
ramverk som uppmuntrar
[goda säkerhetsmetoder](https://codeigniter.com/user_guide/concepts/security.html).

För att maximera din instans säkerhet och förhindra alla skadliga attacker, vi
rekommenderar att du uppdaterar alla dina Castopod-filer behörigheter efter
installation eller uppdateringar (för att undvika eventuella föregående
tillståndsfel):

- `writable/` mapp måste vara **läsbar** och **skrivbar**.
- `public/media/` mapp måste vara **läsbar** och **skrivbar**.
- någon annan fil måste vara inställd på **readonly**.

Till exempel, om du använder Apache eller NGINX med Ubuntu kan du göra följande:

```bash
sudo chown -R root:root /path/to/castopod
sudo chown -R www-data:www-data /path/to/castopod/writable
sudo chown -R www-data:www-data /path/to/castopod/public/media
```
