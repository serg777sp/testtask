<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Doc2\User;
use EntityManager;

class Update_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update {name} {--info=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command for update user's information";

        /**
     * The console command example.
     *
     * @var string
     */
    protected  $example = "Example command: php artisan user:update User_Name --info='if many words in the option then you need to added quotes'";

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
        $info = (!empty($this->option('info'))) ? $this->option('info') : NULL;
        if(!$name || !$info){
            echo 'Command is wrong!' ."\n" . $this->example . "\n";
            return false;
        }
        $user = EntityManager::getRepository(User::class)->findOneBy(['name' => $name]);
        if(!$user){
            echo "User with name - '" . $name . "' not found." . "\n";
            return false;
        }
        $user->setInfo($info);
        EntityManager::flush($user);
        return true;
    }
}
