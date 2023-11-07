<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertMenuItems extends Command
{
    protected $signature = 'insert:menu-items';

    protected $description = 'Insert menu items into the admin_menu table without timestamps';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 9, 'Users', 'icon-users', '/users', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 5, 'Room Types', 'icon-broom', '/room-types', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 3, 'Rooms', 'icon-bed', '/rooms', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 6, 'Branch Addresses', 'icon-city', '/branch-address', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 4, 'Room Images', 'icon-images', '/room-images', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 2, 'Reservations', 'icon-book', '/reservations', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 7, 'Ratings', 'icon-star', '/ratings', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 8, 'Customer Service', 'icon-stethoscope', '/cs', null);
        ");

        $this->info('Menu items inserted successfully.');
    }
}
