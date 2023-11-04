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
//        $connection = $this->option('connection');
//
//        // Use the specified database connection if provided, or fall back to the default connection.
//        if ($connection) {
//            config(['database.default' => $connection]);
//        }

        // Insert data into the admin_menu table without timestamps
        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 2, 'Users', 'icon-users', '/users', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 4, 'Room Types', 'icon-broom', '/room-types', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 3, 'Rooms', 'icon-bed', '/rooms', null);
        ");

        DB::statement("
            INSERT INTO admin_menu (parent_id, `order`, title, icon, uri, permission)
            VALUES (0, 5, 'Branch Addresses', 'icon-city', '/branch-address', null);
        ");

        $this->info('Menu items inserted successfully.');
    }
}
