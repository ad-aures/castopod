---
title: Sécurité
---

# Questions de sécurité

Castopod est développé sur [CodeIgniter4](https://codeigniter.com/), un
framework PHP qui encourage
[de bonnes pratiques de sécurité](https://codeigniter.com/user_guide/concepts/security.html).

Pour garantir au mieux la sécurité de votre instance et éviter les attaques
malveillantes, nous vous recommandons de mettre à jour les permissions des
fichiers de Castopod après l'installation et chaque mise à jour (et éviter toute
erreur de droit d'accès aux fichiers) :

- Le dossier `writable/` doit être accessible en **lecture** et en **écriture**.
- Le dossier `public/media/` doit être accessible en **lecture** et en
  **écriture**.
- tout autre fichier doit être accessible en **lecture seule**.

Par exemple, si vous utilisez Apache ou NGINX avec Ubuntu, vous pouvez exécuter
les commandes suivantes :

```bash
sudo chown -R root:root /path/to/castopod
sudo chown -R www-data:www-data /path/to/castopod/writable
sudo chown -R www-data:www-data /path/to/castopod/public/media
```
