<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Doc2\User;
use EntityManager;

class Create_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {--password=} {--info=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command for the creating a new user.";

    /**
     * The console command example.
     *
     * @var string
     */
    protected  $example = "Example command: php artisan user:create User_Name --password=secret --info='if many words in the option then you need to added quotes'";

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
	$name = (!empty($this->argument('name'))) ? $this->argument('name') : NULL;
	$password = (!empty($this->option('password'))) ? $this->option('password') : NULL;
	$info = (!empty($this->option('info'))) ? $this->option('info') : NULL;
	if($name && $password && $info){
	    $user = new User($name, $password, $info);
	    EntityManager::persist($user);
	    EntityManager::flush();
            return true;
	} else {
	    echo 'Command is wrong!' ."\n" . $this->example . "\n";
	}
    }
}
