---
title: Beveiliging
---

# Veiligheidszorgen

Castopod is built on top of [CodeIgniter4](https://codeigniter.com/), a PHP
framework that encourages
[good security practices](https://codeigniter.com/user_guide/concepts/security.html).

To maximize your instance's safety and prevent any malicious attack, we
recommend you update all your Castopod files permissions after installation or
updates (to avoid any prior permission error):

- `writable/` folder must be **readable** and **writable**.
- `public/media/` folder must be **readable** and **writable**.
- any other file must be set to **readonly**.

For instance, if you are using Apache or NGINX with Ubuntu you may do the
following:

```bash
sudo chown -R root:root /path/to/castopod
sudo chown -R www-data:www-data /path/to/castopod/writable
sudo chown -R www-data:www-data /path/to/castopod/public/media
```
