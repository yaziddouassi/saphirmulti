<?php

namespace Saphir\Multi\Utils\Generator;

class PanelPart
{

public $piece1 ;
public $piece2 ;
public $piece3 ;
public $piece4 ;

public function getPiece1($a,$b,$c) {
    $this->piece1   = "<?php

namespace App\Livewire\Saphir\\$c;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        
      return view('$a',
        ['allRoutes' => \Saphir\Multi\Models\Saphircrud::where('active',true)
        ->where('panel','$b')
        ->get(),
        'user' => \Illuminate\Support\Facades\Auth::user() ,
       ]
        )
        ->layout('saphir::layouts.app');
    }
}
   ";

   return $this->piece1;
}

public function getPiece2() {
     
    $this->piece2   = "<div class=\"min-[800px]:flex w-full\" x-data=\"\">

    @livewire('saphir.sidebar',['allRoutes' => \$allRoutes, 'user' => \$user])
     <div class=\"min-h-[100vh] w-full max-w-[1150px]  overflow-x-auto bg-[#ccc]\">
 
        @include('saphir::topBar')

        <div id=\"conteneur\"
         class=\"grid max-[600px]:grid-cols-1
              max-[1000px]:grid-cols-2 grid-cols-3 p-[10px] pb-[10px] gap-[10px]\">

                @livewire('saphir.widget')
                @livewire('saphir.widget')
                @livewire('saphir.widget')
                @livewire('saphir.chartexample')
                @livewire('saphir.chartexample2') 
                @livewire('saphir.chartexample3')
                @livewire('saphir.widget')
                @livewire('saphir.widget')
                @livewire('saphir.widget')
                            
        </div>
     </div>
 </div>
    
    ";

    return $this->piece2;

}

public function getPiece3($a,$b,$c,$d) {
    $this->piece3 ="
    Route::get('$a', \\App\\Livewire\\Saphir\\$b\Dashboard::class)->middleware('$c');  
    Route::get('$d', \\App\\Livewire\\Saphir\\$b\Login::class);  
        " ;
    
        return $this->piece3;
}



public function getPiece4($chemin,$c) {
    $this->piece4 ="<?php

namespace App\Livewire\Saphir\\$c;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    
    public \$email = '';
    public \$password = '';
    public \$remember = false;
    public \$chemin = '';

    protected \$rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function mount() {
        if (auth()->check()) {
            return \$this->redirect(\$this->chemin, navigate: true);
        }
        \$this->chemin = '$chemin' ;
    }

    public function login()
    {
        \$this->validate();

        if (Auth::attempt(['email' => \$this->email, 'password' => \$this->password], \$this->remember)) {
            session()->flash('message', 'Logged in successfully.');
            return \$this->redirect(\$this->chemin, navigate: true);
        } else {
            session()->flash('error', 'Invalid email or password.');
        }
    }
    
    

    public function render()
    {
        return view('saphir::livewire.saphir8')
        ->layout('saphir::layouts.app3');
    }
}

        " ;
    
        return $this->piece4;
}






    
}
