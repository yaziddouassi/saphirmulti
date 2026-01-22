<?php

namespace Saphir\Multi\Livewire;
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;

class Saphir6 extends Component
{

    use WithPagination;

    public $listModels = [];
    public $selected = []; 
    public $lepanel = '';
    protected $transformString = null;

    public $panels;

    public function mount() {
       $this->panels =  config('saphir.panelList');
       $this->listModels = config('saphir.modelList');
      
       $this->transformString = new \Saphir\Multi\Utils\Generator\TransformString(); 
    }

   
    public function initModel()
    {
        $path = app_path('Models');

        foreach (File::files($path) as $file) {
            
            $this->listModels[] =  pathinfo($file->getFilename(), PATHINFO_FILENAME);
        }

    }


    public function ajouter()
    {
        $validated = $this->validate([ 
            'selected' => ['required'],
            'lepanel' => ['required'],
        ]
        );  
        
        foreach ($this->selected as $key => $value) {
            $transformString = new \Saphir\Multi\Utils\Generator\TransformString();
            $crud = new \Saphir\Multi\Models\Saphircrud() ;
            $crud->panel  =  $this->lepanel;
            $crud->model  =  $value;
            $crud->label  = $transformString->transformLink($value) ;
            $crud->route  = '/' . $this->lepanel . '/' . $transformString->transformUrl($value) ;
            $crud->icon  = 'description' ;
            $crud->active  = true ;
            $crud->save()  ;
        }
    
      $this->js("const notyf = new Notyf({ position: {x: 'right',y: 'top'}});
      notyf.success('Routes added!');"); 
      return $this->redirect('/saphir/route-generator', navigate: true);
    }


    public function render()
    {
        return view('saphir::livewire.saphir6',
        ['allRoutes' => \Saphir\Multi\Models\Saphircrud::where('active',true)->get(),
        'user' => \Illuminate\Support\Facades\Auth::user() ,
       ]
        )
        ->layout('saphir::layouts.app');
    }
}
