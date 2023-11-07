<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class InitApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initializes the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $processes = [
            new Process(['composer', 'install']),
            new Process(['php','artisan','vendor:publish','--provider="OpenAdmin\Admin\AdminServiceProvider"']),
            new Process(['cp','.env.example','.env']),
            new Process(['php','artisan','key:generate']),
            new Process(['php','artisan','migrate:fresh']),
            new Process(['php','artisan','admin:install']),
            new Process(['php','artisan','db:seed']),
            new Process(['php','artisan','admin:import', 'config']),
            new Process(['php','artisan','admin:import', 'helpers']),
            new Process(['php','artisan','admin:import', 'media-manager']),
            new Process(['php','artisan','admin:import', 'scheduling']),
            new Process(['php','artisan','admin:import', 'log-viewer']),
            new Process(['php','artisan','insert:menu-items']),
            new Process(['npm', 'install']),

        ];

        foreach ($processes as $process) {
            $process->run();

            if ($process->isSuccessful()) {
                $output = $process->getOutput();
                echo $output;
            } else {
                echo 'An error occurred: ' . $process->getOutput();
            }
        }
        
    }

}
