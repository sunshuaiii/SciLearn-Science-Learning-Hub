# SciLearn Science Learning Hub
A science learning web application created using Laravel framework.

# Setting up this application

# # in phpMyAdmin
1. Database name                    `scilearn`
2. Database collation               `utf8mb4_unicode_ci`

# # in CLI
1. Rollback previous migrations     `php artisan migrate:reset`
2. Migrate all migration files      `php artisan migrate`
3. Seed all seeder files            `php artisan db:seed`
4. Rollback, migrate, and seed      `php artisan migrate:refresh --seed`    

## authentication
two guards: admin and student
one model: user

## admin authentication
one time register
url: localhost/register/admin
url: localhost/login/admin
admin cannot login from localhost/login/student

cannot retrieve what guard is used for authentication
so create a session to remember the role of the user