<?php

namespace Saphir\Multi\Livewire;
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;

class Saphir4 extends Component
{
    use WithPagination;

    public $search;
    public $panels;

    public function mount() {
       $this->panels =  config('saphir.panelList');
    }

    public function toggle($a , $b) {

        if ($b == 1) {
            \Saphir\Multi\Models\Saphircrud::where('id',$a)
                          ->update(['active' => false]) ;
        }
        if ($b == 2) {
            \Saphir\Multi\Models\Saphircrud::where('id',$a)
                          ->update(['active' => true]) ;
        }

        $this->js("const notyf = new Notyf({ position: {x: 'right',y: 'top'}});
        notyf.success('Route updated!');"); 
    }

    public function deleteById($id) {

        \Saphir\Multi\Models\Saphircrud::destroy($id) ;
        $this->js("const notyf = new Notyf({ position: {x: 'right',y: 'top'}});
        notyf.success('Route deleted!');"); 
    }

    public function render()
    {

        if($this->search == '') {
          $temp = \Saphir\Multi\Models\Saphircrud::paginate(1);
        }

        if($this->search != '') {
           $temp =  \Saphir\Multi\Models\Saphircrud::where('panel',$this->search)->paginate(1);
        }


        return view('saphir::livewire.saphir4',
        ['allRoutes' => \Saphir\Multi\Models\Saphircrud::where('active',true)->get(),
        'allRoutes2' => $temp,
        'user' => \Illuminate\Support\Facades\Auth::user() ,
       ]
        )
        ->layout('saphir::layouts.app');
    }
}