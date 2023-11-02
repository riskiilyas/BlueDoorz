# BlueDoorz
### Hotel Reservation & Management System
<p align="center">
<img src="https://github.com/riskiilyas/BlueDoorz/assets/71499142/ab4ec38f-ee48-4b9d-90be-9b4d0323a708" width="200px"/>
</p>

### Group Members
- Riski Ilyas (5025211189)
- Mikhael Aryasatya N (5025211062)

## Installation
Copy these commands:
```
composer migrate:fresh
composer db:seed
composer install
php artisan vendor:publish --provider="OpenAdmin\Admin\AdminServiceProvider"
php artisan admin:install
php artisan admin:import helpers
php artisan admin:import media-manager
php artisan admin:import scheduling
php artisan admin:import log-viewer
```
