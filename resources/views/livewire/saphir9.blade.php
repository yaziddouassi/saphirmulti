<div class="flex w-full"  x-data="{ 
}">

    @livewire('saphir.sidebar2',['allRoutes' => $allRoutes, 'user' => $user])
    
     <div class="min-h-[100vh] w-full max-w-[1150px]  overflow-x-auto  bg-[#DFDFDF]">
       
        <div class="max-w-2xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Créer un Panel</h2>

        @if($message)
            <div class="mb-4 p-4 rounded-md {{ $messageType === 'success' ? 'bg-green-100 text-green-700 border border-green-400' : 'bg-red-100 text-red-700 border border-red-400' }}">
                {{ $message }}
            </div>
        @endif

        <form wire:submit.prevent="createPanel">
            <!-- Sélection du Panel -->
            <div class="mb-6">
                <label for="panel" class="block text-sm font-medium text-gray-700 mb-2">
                    Choisir un panel <span class="text-red-500">*</span>
                </label>
                <select 
                    id="panel" 
                    wire:model="selectedPanel" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('selectedPanel') border-red-500 @enderror"
                >
                    <option value="">-- Sélectionnez un panel --</option>
                    @foreach($panelList as $panel)
                        <option value="{{ $panel }}">{{ ucfirst($panel) }}</option>
                    @endforeach
                </select>
                @error('selectedPanel')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                @if($selectedPanel)
                    <p class="mt-2 text-sm text-gray-600">
                        Vous avez choisi : <span class="font-semibold">{{ $selectedPanel }}</span>
                    </p>
                @endif
            </div>

            <!-- Sélection du Middleware -->
            <div class="mb-6">
                <label for="middleware" class="block text-sm font-medium text-gray-700 mb-2">
                    Choisir un middleware <span class="text-red-500">*</span>
                </label>
                <select 
                    id="middleware" 
                    wire:model="selectedMiddleware" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('selectedMiddleware') border-red-500 @enderror"
                >
                    <option value="">-- Sélectionnez un middleware --</option>
                    @foreach($middlewareList as $mw)
                        <option value="{{ $mw }}">{{ $mw }}</option>
                    @endforeach
                </select>
                @error('selectedMiddleware')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                @if($selectedMiddleware)
                    <p class="mt-2 text-sm text-gray-600">
                        Vous avez choisi : <span class="font-semibold">{{ $selectedMiddleware }}</span>
                    </p>
                @endif
            </div>

            <!-- Bouton de soumission -->
            <div class="flex items-center justify-between">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Créer le Panel</span>
                    <span wire:loading>Création en cours...</span>
                </button>

                <div wire:loading class="text-sm text-gray-600">
                    <svg class="inline w-4 h-4 mr-2 animate-spin" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Traitement...
                </div>
            </div>
        </form>
    </div>
</div>
       

     </div>

 
     
 </div>