<?php

namespace App\Console\Commands;

use App\Models\Signup\Location;
use Illuminate\Console\Command;
use Illuminate\Config\Repository as Config;

class SeedLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed:signup:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed signup_locations table from config.signup';

    /* @var Config */
    protected $config;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Config $config)
    {
        parent::__construct();
        $this->config = $config;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Reading location data.');
        $locations = $this->config->get('signup.locations');
        foreach ($locations as $location) {
            if ($entity = Location::where('name', $location['name'])->first()) {
                $entity->update($location);
                $this->info("Location {$entity->name} updated.");
            } else {
                $entity = Location::create($location);
                $this->info("Location {$entity->name} added.");
            }
        }
        $this->info('Done adding location data.');
    }
}
