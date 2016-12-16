# hackhaton2
Ce projet est issu du 2e hackhaton WCS 

# Pré-requis

Avoir "composer" d'installé ==> https://getcomposer.org/doc/00-intro.md

# Initialisation du projet

- SSH git clone git@github.com:florianpdf/hackathon_matchMyPic.git
- HTTPS git clone https://github.com/Anthooo/hackhaton2.git
- cd hackathon2
- composer install
- php app/console doctrine:database:create php app/console doctrine:schema:update --force
- php app/console assets:install
