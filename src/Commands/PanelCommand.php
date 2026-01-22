<?php

namespace  Saphir\Multi\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PanelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:panel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Panel Installation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $installor = new \Saphir\Multi\Utils\Generator\PanelPart();
        $filePathRouter = base_path('routes/web.php');


        $panelList = config('saphir.panelList', []);
        

        // Vérifier s’il y a des modèles
        if (empty($panelList)) {
            $this->error("No panel in config('saphir.panelList').");
            return 1;
        }

        // Demander à l’utilisateur de choisir
        $choix = $this->choice('Choose a panel ?', $panelList, 0);

        $this->info("You Choose this panel : $choix");

        $panelCamel = ucfirst($choix);


        $middlewareList = config('saphir.middlewareList', []);

        if (empty($panelList)) {
            $this->error("No panel in config('saphir.middlewareList').");
            return 1;
        }

        
        $middleware = $this->choice('Choose a middleware ?', $middlewareList, 0);

        $this->info("You Choose this middleware : $middleware");



        
        if (!File::exists("app/Livewire/Saphir")) {
            File::makeDirectory("app/Livewire/Saphir", 0755, true);
        }

        if (!File::exists("resources/views/livewire/saphir")) {
            File::makeDirectory("resources/views/livewire/saphir", 0755, true);
        }


        $var1 =  'livewire.saphir.' . $choix .'.dashboard' ;

        $piece1 = $installor->getPiece1($var1,$choix,$panelCamel);
        $tempFilePath1 = 'app/Livewire/Saphir/' .$panelCamel. '/Dashboard.php' ;
        $tempFilePath1b = 'app/Livewire/Saphir/' .$panelCamel ;

        $chemin = '/' . $choix;
        $piece4 = $installor->getPiece4($chemin,$panelCamel);
        $tempFilePath4 = 'app/Livewire/Saphir/' .$panelCamel. '/Login.php' ;

        if (!File::exists($tempFilePath1b)) {
            File::makeDirectory($tempFilePath1b, 0755, true);
        }

        $filePath1 = base_path($tempFilePath1);
        $filePath4 = base_path($tempFilePath4);


        $piece2 = $installor->getPiece2();
        $tempFilePath2 = 'resources/views/livewire/saphir/' .$choix.  '/dashboard.blade.php' ;
        $tempFilePath2b = 'resources/views/livewire/saphir/' .$choix ;

       

        if (!File::exists($tempFilePath2b)) {
            File::makeDirectory($tempFilePath2b, 0755, true);
        }

        $filePath2 = base_path($tempFilePath2);

        $var2 =  '/' . $choix ;
        $var3 =  '/' . $choix . '/login' ;

        $piece3 = $installor->getPiece3($var2,$panelCamel,$middleware,$var3);
        $filePath3 = base_path('routes/saphir.php');
        
        File::append($filePath1 , $piece1);
        File::append($filePath2 , $piece2);
        File::append($filePath3 , $piece3);
        File::append($filePath4 , $piece4);
     //   File::append($filePathRouter ,"require __DIR__.'/saphir.php';" );

        $this->info("Panel created");
    }
}
