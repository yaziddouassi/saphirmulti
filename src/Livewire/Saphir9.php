<?php

namespace Saphir\Multi\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Saphir\Multi\Utils\Generator\PanelPart;

class Saphir9 extends Component
{
    public $panelList = [];
    public $middlewareList = [];
    public $selectedPanel = '';
    public $selectedMiddleware = '';
    public $message = '';
    public $messageType = '';

    public function mount()
    {
        $this->panelList = config('saphir.panelList', []);
        $this->middlewareList = config('saphir.middlewareList', []);
        
    }

   
     public function createPanel()
    {
        // Validation
        $this->validate([
            'selectedPanel' => 'required',
            'selectedMiddleware' => 'required',
        ], [
            'selectedPanel.required' => 'Veuillez sélectionner un panel.',
            'selectedMiddleware.required' => 'Veuillez sélectionner un middleware.',
        ]);

        // Vérifier s'il y a des panels
        if (empty($this->panelList)) {
            $this->messageType = 'error';
            $this->message = "Aucun panel dans config('saphir.panelList').";
            return;
        }

        // Vérifier s'il y a des middlewares
        if (empty($this->middlewareList)) {
            $this->messageType = 'error';
            $this->message = "Aucun middleware dans config('saphir.middlewareList').";
            return;
        }

        try {
            $installor = new PanelPart();
            $choix = $this->selectedPanel;
            $middleware = $this->selectedMiddleware;
            $panelCamel = ucfirst($choix);

            // Créer les répertoires si nécessaire
            if (!File::exists("app/Livewire/Saphir")) {
                File::makeDirectory("app/Livewire/Saphir", 0755, true);
            }

            if (!File::exists("resources/views/livewire/saphir")) {
                File::makeDirectory("resources/views/livewire/saphir", 0755, true);
            }

            // Générer les pièces
            $var1 = 'livewire.saphir.' . $choix . '.dashboard';
            $piece1 = $installor->getPiece1($var1, $choix, $panelCamel);
            
            $tempFilePath1 = 'app/Livewire/Saphir/' . $panelCamel . '/Dashboard.php';
            $tempFilePath1b = 'app/Livewire/Saphir/' . $panelCamel;
            
            $chemin = '/' . $choix;
            $piece4 = $installor->getPiece4($chemin, $panelCamel);
            $tempFilePath4 = 'app/Livewire/Saphir/' . $panelCamel . '/Login.php';

            if (!File::exists($tempFilePath1b)) {
                File::makeDirectory($tempFilePath1b, 0755, true);
            }

            // S'assurer que tous les répertoires parents existent
            $filePath1 = base_path($tempFilePath1);
            $filePath4 = base_path($tempFilePath4);
            
            // Créer le répertoire parent pour filePath1 si nécessaire
            $dir1 = dirname($filePath1);
            if (!File::exists($dir1)) {
                File::makeDirectory($dir1, 0755, true);
            }

            $piece2 = $installor->getPiece2();
            $tempFilePath2 = 'resources/views/livewire/saphir/' . $choix . '/dashboard.blade.php';
            $tempFilePath2b = 'resources/views/livewire/saphir/' . $choix;

            if (!File::exists($tempFilePath2b)) {
                File::makeDirectory($tempFilePath2b, 0755, true);
            }

            $filePath2 = base_path($tempFilePath2);

            $var2 = '/' . $choix;
            $var3 = '/' . $choix . '/login';
            $piece3 = $installor->getPiece3($var2, $panelCamel, $middleware, $var3);
            $filePath3 = base_path('routes/saphir.php');

            // Créer le répertoire routes si nécessaire
            $dirRoutes = dirname($filePath3);
            if (!File::exists($dirRoutes)) {
                File::makeDirectory($dirRoutes, 0755, true);
            }

            // Écrire les fichiers (utiliser put au lieu de append pour créer les fichiers)
            File::put($filePath1, $piece1);
            File::put($filePath2, $piece2);
            File::append($filePath3, $piece3);
            File::put($filePath4, $piece4);

            $this->messageType = 'success';
            $this->message = "Panel '$choix' créé avec succès avec le middleware '$middleware' !";
            
            // Réinitialiser le formulaire
            $this->reset(['selectedPanel', 'selectedMiddleware']);
            $this->mount();
            
        } catch (\Exception $e) {
            $this->messageType = 'error';
            $this->message = "Erreur lors de la création du panel : " . $e->getMessage();
        }
    }


    public function render()
    {
         return view('saphir::livewire.saphir9',
        ['allRoutes' => \Saphir\Multi\Models\Saphircrud::where('active',true)->get(),
        'user' => \Illuminate\Support\Facades\Auth::user() ,
       ]
        )
        ->layout('saphir::layouts.app');
    }
}