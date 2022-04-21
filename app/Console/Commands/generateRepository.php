<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Pluralizer;

class generateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--directory=} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make repository from base repository';

    protected Filesystem $files;
    protected string $repositoryContent;
    protected string $interfaceContent;
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
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    public function handle()
    {
        $directoryPath = base_path('App\\Repositories') .'\\' .$this->option("directory");
        $this->makeDirectory($directoryPath);

        //generate content of repository
        $this->repositoryContent = $this->files->get($this->getRepositoryPath());
        $contents = $this->getStubContents($this->repositoryContent,$this->getRepositoryVariables());

        //generate repository
        $path = $this->getSourceFilePath();
        if (!$this->files->exists($path["repository"])) {
            $this->files->put($path["repository"], $contents);
            $this->info("File : {$path["repository"]} created");
        } else {
            $this->info("File : {$path["repository"]} already exits");
        }

        //generate content of interface
        $this->interfaceContent = $this->files->get($this->getInterfacePath());
        $contents = $this->getStubContents($this->interfaceContent,$this->getInterfaceVariables());

        //generate repository
        if (!$this->files->exists($path["interface"])) {
            $this->files->put($path["interface"], $contents);
            $this->info("File : {$path["interface"]} created");
        } else {
            $this->info("File : {$path["interface"]} already exits");
        }
    }

    public function getRepositoryPath ()
    {
        return base_path(). '/stubs/repository.stub';
    }
    public function getInterfacePath ()
    {
        return base_path(). '/stubs/repositoryInterface.stub';
    }
    public function getRepositoryVariables()
    {
        return [
            'namespace'         => 'App\\Repositories\\'.$this->getSingularClassName($this->option('directory')),
            'name'        => $this->getSingularClassName($this->argument('name')),
            'model'             => $this->getSingularClassName($this->option('model')),
            'interface'             =>$this->getSingularClassName($this->argument('name'))."Interface",
        ];
    }

    public function getInterfaceVariables()
    {
        return [
            'name'         => $this->getSingularClassName($this->argument('name'))."Interface",
            'namespace'         => 'App\\Repositories\\'.$this->getSingularClassName($this->option('directory')),
        ];
    }

    protected function replaceType($stub,$type, $name): string
    {
        return str_replace($type,$name,$stub);
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

    public function getSourceFilePath()
    {
        return [
            "repository" => base_path('App\\Repositories') .'\\' .$this->option('directory') .'\\'. $this->argument('name').".php",
            "interface" => base_path('App\\Repositories') .'\\' .$this->option('directory') .'\\'. $this->argument('name')."Interface".".php",
        ];
    }
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }
}
