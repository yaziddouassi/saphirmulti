<?php

namespace Saphir\Multi\Livewire;
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
use Livewire\Component;
use Illuminate\Support\Facades\File;


class Chartexample extends Component
{
    public $data = [] ;
    public $labels = [] ;
    public $label ;
    public $chartId ;
    public $chartType ;
    public $backgroundColor = array() ;

    public function mount($chartId,$label,$data,$labels,$chartType,$backgroundColor)
    {
        $this->chartId = 'Chartexample' ;
        $this->label = 'Best Sailings'  ;
        $this->data = [1,2,3,8]  ;
        $this->labels = ['first','second','third','four']  ;
        $this->chartType = 'bar';
        $this->backgroundColor = ['blue','red','black','lime'];

        $this->chartId = $chartId;
        $this->label = $label;
        $this->data = $data;
        $this->labels = $labels;
        $this->chartType = $chartType;
        $this->backgroundColor = $backgroundColor;

    }

    public function chartchange()
    {
        $this->data= [1,2,3]  ;
        $this->labels = ['first','second','third']  ;
       
    }


    public function render()
    {
        return view('saphir::livewire.chart');
    }
}
