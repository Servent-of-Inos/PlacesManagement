In order to make it work:
1) Set your db connection information in .env file in the root of the project.
2) Add php dependencies: composer install.
3) Add JavaScript dependencies: npm install.
2) Generate key for that App: php artisan key:generate.
3) Migrate and seed db with information from areas.php (fill free to add to this file in database\seed\areas.php directory in order to seed more places): php artisan migrate --seed.
4) If all fine it should be work now.