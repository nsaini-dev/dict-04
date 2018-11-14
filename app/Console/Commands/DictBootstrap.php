<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Artisan;

class DictBootstrap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dict:bootstrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create empty files - migration, model and controller';

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
        $this->cleanDirectories();
        $this->createFiles();
    }


    /**
     * CUSTOM FUNCTIONS
     */


    public function cleanDirectories()
    {
        $fs = new Filesystem;
        $paths = [
            'database/migrations',
            'app/Models',
            'app/Http/Controllers/Pages'
        ];

        $this->info('');

        foreach($paths as $path) {
            $fs->cleanDirectory($path); 
            $this->info('Cleaned :: ' . $path);

            if($fs->isDirectory($path) === false) {
                $fs->makeDirectory($path);
                $this->info('Created :: ' . $path);
            }
        }
    }


    public function createFiles()
    {
        $tables = array(
            // LIST TABLES
            'lst_tags'                      => ['m'=>true, 'c'=>true],  
            'lst_sources'                   => ['m'=>true, 'c'=>true],  
            'lst_priority_levels'           => ['m'=>true, 'c'=>true], 
            'lst_proficiency_levels'        => ['m'=>true, 'c'=>true],
            'lst_proficiency_sublevels'     => ['m'=>true, 'c'=>true],
            'lst_word_cases'                => ['m'=>true, 'c'=>false],  
            'lst_word_types'                => ['m'=>true, 'c'=>false],
            // DATA TABLES
            'de_words'                      => ['m'=>true, 'c'=>true],  
            'en_words'                      => ['m'=>true, 'c'=>true],  
            'de_sentences'                  => ['m'=>true, 'c'=>true],  
            'en_sentences'                  => ['m'=>true, 'c'=>true],  
            'de_word_infos'                 => ['m'=>true, 'c'=>true],  
            'de_sentence_infos'             => ['m'=>true, 'c'=>true],  
            'de_word_noun_infos'            => ['m'=>true, 'c'=>false],  
            'de_word_verb_infos'            => ['m'=>true, 'c'=>false],  
            'de_word_preposition_infos'     => ['m'=>true, 'c'=>false],  
            // MAP TABLES
            'map_deword_enword'         => ['m'=>true, 'c'=>false],
            'map_deword_tag'            => ['m'=>true, 'c'=>false],
            'map_deword_wordtype'       => ['m'=>true, 'c'=>false],
            'map_desentence_deword'     => ['m'=>true, 'c'=>false],
            'map_desentence_ensentence' => ['m'=>true, 'c'=>false],
            'map_ensentence_enword'     => ['m'=>true, 'c'=>false],
        );

        foreach($tables as $table => $opts) 
        {
            $filenames = [
                'migration'  => 'create_' . $table . '_table',
                'model'      => 'Models/' . ucfirst(camel_case(str_singular($table))),
                'controller' => 'Pages/' . ucfirst(camel_case(str_singular($table))) . 'Controller',
            ];

            $this->info('');
            $this->make_migration($filenames['migration'] , $opts);
            $this->make_model($filenames['model'], $opts);
            $this->make_controller($filenames['controller'], $opts);
            sleep(1);
        }
        $this->info('');
    }

    private function make_migration($filename, $opts)
    {
        Artisan::call("make:migration", array(
            'name' => $filename
        ));

        $this->info("make:migration :: " . $filename);
    }

    private function make_model($filename, $opts)
    {
        if($opts['m'] == false) return false;

        Artisan::call("make:model", array(
            'name' => $filename
        ));

        $this->info("make:model :: " . $filename);
    }

    private function make_controller($filename, $opts)
    {
        if($opts['c'] == false) return false;

        Artisan::call("make:controller", array(
            'name' => $filename,
            '-r' => true
        ));

        $this->info("make:controller :: " . $filename);
    }

}
