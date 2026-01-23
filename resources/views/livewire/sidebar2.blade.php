<div>
    @livewire('saphir.navbar2',['allRoutes' => $allRoutes ,'user' => $user])

    <div class="max-[799px]:hidden  min-w-[240px] max-w-[240px] bg-black text-white h-full min-h-[100vh] p-[10px] pt-[5px]">
    <div class="p-[4px] bg-[blue] text-center border-[1px] font-bold border-white text-[22px] rounded-[2px] mb-[10px]">
        <a href="/admin" wire:navigate >DEV</a>
    </div>

    <div class="p-[4px]  text-center border-[1px] font-bold border-white text-[22px] rounded-[2px] mb-[10px]"
    onclick="confirm('do you want logout?')
               || event.stopImmediatePropagation()"
     wire:click="logout()"           
    >
        LOGOUT
    </div>
    
    
  

    
    @include('saphir::saphir.sidebar.sidewidget2')
   </div>
</div>