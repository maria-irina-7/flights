<!-- Search Form -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <form 
            method="POST" 
            action="{{ route('flights.search') }}" 
            class="">
            @csrf
            <div class="flex flex-row items-center gap-2">
                
                <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full" @click.away="isOpen = false">
                    <x-text-input
                        id="origin"
                        name="origin"
                        type="text"
                        class="w-full form-control p-4"
                        placeholder="Origin"
                        autocomplete="off"
                        x-model="searchTerm"
                        @input.debounce.300ms="
                            if (searchTerm.length > 1) {
                                fetch(`/airport-suggest?q=${encodeURIComponent(searchTerm)}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        results = data;
                                        isOpen = true;
                                    });
                            } else {
                                results = [];
                                isOpen = false;
                            }
                        "
                        @focus="searchTerm.length > 1 && (isOpen = true)"
                    />
                    <div x-show="isOpen" class="absolute w-full mt-1 bg-gray-900 border border-gray-700 rounded-lg shadow-lg z-50 max-h-60 overflow-auto text-white">
                        <template x-for="result in results" :key="result.id">
                            <div @mousedown.prevent="searchTerm = result.code; isOpen = false; $el.blur();" class="px-4 py-2 cursor-pointer hover:bg-blue-900 hover:text-blue-200">
                                <span x-text="result.name"></span>
                                <span class="text-xs text-gray-400" x-text="`(${result.code}) - ${result.city}, ${result.country}`"></span>
                            </div>
                        </template>
                        <div x-show="results.length === 0 && searchTerm.length > 1" class="px-4 py-2 text-gray-400">No results</div>
                    </div>
                </div>
                <!-- Destination Airport Autocomplete with original style -->
                <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full" @click.away="isOpen = false">
                    <x-text-input
                        id="destination"
                        name="destination"
                        type="text"
                        class="w-full form-control p-4"
                        placeholder="Destination (optional)"
                        autocomplete="off"
                        x-model="searchTerm"
                        @input.debounce.300ms="
                            if (searchTerm.length > 1) {
                                fetch(`/airport-suggest?q=${encodeURIComponent(searchTerm)}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        results = data;
                                        isOpen = true;
                                    });
                            } else {
                                results = [];
                                isOpen = false;
                            }
                        "
                        @focus="searchTerm.length > 1 && (isOpen = true)"
                    />
                    <div x-show="isOpen" class="absolute w-full mt-1 bg-gray-900 border border-gray-700 rounded-lg shadow-lg z-50 max-h-60 overflow-auto text-white">
                        <template x-for="result in results" :key="result.id">
                            <div @mousedown.prevent="searchTerm = result.code; isOpen = false; $el.blur();" class="px-4 py-2 cursor-pointer hover:bg-blue-900 hover:text-blue-200">
                                <span x-text="result.city"></span>
                                <span class="text-xs text-gray-400" x-text="`(${result.code}) - ${result.name}, ${result.country}`"></span>
                            </div>
                        </template>
                        <div x-show="results.length === 0 && searchTerm.length > 1" class="px-4 py-2 text-gray-400">No results</div>
                    </div>
                </div>
                <div class="col-md-4 h-full">
                    <x-primary-button 
                    type="submit" 
                    class="btn btn-primary w-100 h-full py-4">
                        Search
                    </x-primary-button>
                </div>
            </div>
        </form> 
    </div>