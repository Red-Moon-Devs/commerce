<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Module d'authentification


### Fonctionnalités principales
- Gestion des rôles (admin, gestionnaire, client).
- Redirection basée sur les rôles.
- Vérification des emails pour les clients.
- Gestion de la récupération de mot de passe.
- Middleware pour restreindre l'accès en fonction des rôles.
- gestion des erreurs de pages ( 404 & 403)

### Instructions pour tester
1. Clonez le dépôt : `git clone https://github.com/GoldenDev74/commerce.git`.
2. Installez les dépendances : `composer install`. & `npm install`

4. Configurez l'environnement : `.env`.
   ```
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=redmoondevs2024@gmail.com
    MAIL_PASSWORD=nmhvmabbfaeedmxw
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=redmoondevs2024@gmail.com
    MAIL_FROM_NAME=SkydashEcommerce
   ```
6. Ajoute la méthode suivante dans le fichier AppServiceProvider.php dans le répertoire app/Providers :
```
 public function boot()
    {
        // Définit la taille par défaut des colonnes string
        Schema::defaultStringLength(191);
    }
```
4. Exécutez les migrations : `php artisan migrate`.
5. Seed la base de données : `php artisan db:seed --class=UserSeeder`. pour créer l'admin et le gestionnaire
    * Admin :
         . email: admin@gmail.com
         . mot de passe: admin2024
    * Gestionnaire :
        . email: gestionnaire@gmail.com
        . mot de passe : gestion2024
  
7. Lancez le serveur : `php artisan serve`.

## Appendix

pour tester les mails on a utiliser smtp de gmail. Pour ce faire, ajouter un nouveau compte google à vos compte avec les identifiant suivantes:
 - email : redmoondevs2024@gmail.com
 - mot de passe : redmoon102024

## Contributing
Voici les collaborateurs intervenues !
- GoldenDev74
- Mabel4008
- Steventog
- Antoine 253

## ScreenShoot

![image](https://github.com/user-attachments/assets/1e52abf4-af54-4759-a731-de12a550c3da)

![image](https://github.com/user-attachments/assets/6dfe56e0-ecc9-45e4-8de3-c3e59acb5b25)

![image](https://github.com/user-attachments/assets/acc6a562-d0c8-445b-8e62-9f908508a011)

![image](https://github.com/user-attachments/assets/c6e8ae3e-7f79-4e21-a1f0-32d34c9d97b5)

![image](https://github.com/user-attachments/assets/68d2fba6-618b-4d25-bf59-4f5e262d5e1e)

![image](https://github.com/user-attachments/assets/0e3ada22-66cb-46f5-ac81-a8fc6693e9c3)

![image](https://github.com/user-attachments/assets/a1702d40-f7b6-43ef-9713-5d7ee676637d)

![image](https://github.com/user-attachments/assets/49501512-a7f6-4d96-8dfb-61fdf325228a)

![Capture d'écran 2024-12-19 145703](https://github.com/user-attachments/assets/bd8b6f07-be5d-4823-ac78-1b380fa21925)

![Capture d'écran 2024-12-19 150352](https://github.com/user-attachments/assets/e09c7179-d621-436f-b738-65c1d8ddec05)


