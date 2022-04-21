<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Pluralizer;

class generateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name} {--directory=} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make service';

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

    protected Filesystem $files;
    protected string $content;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $directoryPath = base_path('App\\Services') .'\\' .$this->option("directory");
        $this->makeDirectory($directoryPath);

        //generate content of repository
        $this->content = $this->files->get($this->getServicePath());
        $contents = $this->getStubContents($this->content,$this->getServiceVariables());
        $path = $this->getSourceFilePath();
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }
    }

    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }
    public function getServicePath ()
    {
        return base_path(). '/stubs/service.stub';
    }

    public function getSourceFilePath()
    {
        return base_path('App\\Services') .'\\' .$this->option('directory') .'\\'. $this->argument('name')."Service.php";
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

    public function getServiceVariables()
    {
        return [
            'namespace'         => 'App\\Services\\'.$this->getSingularClassName($this->option('directory')),
            'name'              => $this->getSingularClassName($this->argument('name')),
            'model'             => $this->getSingularClassName($this->option('model')),
            'method'            => strtolower($this->argument('name')),
        ];
    }
}
