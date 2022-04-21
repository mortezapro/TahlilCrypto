<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Pluralizer;

class generateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:controller.service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate controller with service';

    protected Filesystem $files;
    protected string $content;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->files = App::make(Filesystem::class);
    }


    public function handle()
    {
        $this->content = $this->files->get($this->getControllerPath());
        $contents = $this->getStubContents($this->content,$this->getStubVariables());
        $path = $this->getSourceFilePath();
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }
    }
    public function getControllerPath ()
    {
        return base_path(). '/stubs/controller.service.stub';
    }
    public function getSourceFilePath()
    {
        return base_path('App\\Http\\Controllers') .'\\'. $this->argument('name')."Controller.php";
    }
    public function getStubContents($stub , $stubVariables = [])
    {
        foreach ($stubVariables as $search => $replace)
        {
            $stub = str_replace('{{'.$search.'}}' , $replace, $stub);
            $stub = str_replace('{{ '.$search.' }}' , $replace, $stub);
        }

        return $stub;
    }
    public function getStubVariables()
    {
        return [
            'name'        => $this->getSingularClassName($this->argument('name')),
            'method'      => strtolower($this->argument('name')),
        ];
    }
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }
}
