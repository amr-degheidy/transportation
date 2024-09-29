<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GenerateRoutesJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:routes-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate JSON file that has all routes to use';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = $this->getRoutes();

        $json = json_encode($routes, JSON_PRETTY_PRINT);

        file_put_contents(base_path('resources/backend-routes.json'), $json);

        $this->info('Routes JSON file generated successfully.');
    }

    protected function getRoutes()
    {
        $routes = [];
        foreach (Route::getRoutes() as $route) {
            if (str_contains($route->uri, 'api')) {

            $routes[$route->getName() ] =str_replace('api','', $route->uri);
        }
    }

        return $routes;
    }
}
