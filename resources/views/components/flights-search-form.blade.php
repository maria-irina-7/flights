<!-- Search Form -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight py-4">
    <form 
        method="POST" 
        action="{{ route('flights.search') }}" 
        class="">
        @csrf
        <div class="grid sm:grid-cols-2 lg:grid-cols-9 items-center gap-1">
            <div x-data="{isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                <x-airport-search-input
                    id="origin"
                    name="origin"
                    type="text"
                    class="w-full form-control py-4 px-5 rounded-t-lg sm:rounded-t-none sm:rounded-tl-lg  lg:rounded-l-xl"
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

                <!-- Autocomplete Dropdown for Origin Airport -->
                <div x-show="isOpen" class="absolute w-full mt-1 bg-gray-900 border border-gray-700 rounded-b-lg lg:rounded-lg shadow-lg z-50 max-h-60 overflow-auto text-white">
                    <template x-for="result in results" :key="result.id">
                        <div @mousedown.prevent="searchTerm = result.code; isOpen = false; $el.blur();" class="px-4 py-2 cursor-pointer hover:bg-blue-900 hover:text-blue-200">
                            <div x-text="`${result.city} (${result.code})`"></div>
                            <div class="text-xs text-gray-400" x-text="`${result.country} - ${result.name}`"></div>
                        </div>
                    </template>
                    <div x-show="results.length === 0 && searchTerm.length > 1" class="px-4 py-2 text-gray-400">No results</div>
                </div>
            </div>

            <!-- Destination Airport -->
            <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                <x-airport-search-input 
                    id="destination"
                    name="destination"
                    type="text"
                    class="w-full form-control py-4 px-5 sm:rounded-tr-lg lg:rounded-tr-none"
                    placeholder="Destination"
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

                <!-- Autocomplete Dropdown for Destination Airport -->
                <div x-show="isOpen" class="absolute w-full mt-1 bg-gray-900 border border-gray-700 rounded-b-lg lg:rounded-lg shadow-lg z-50 max-h-60 overflow-auto text-white">
                    <template x-for="result in results" :key="result.id">
                        <div @mousedown.prevent="searchTerm = result.code; isOpen = false; $el.blur();" class="px-4 py-2 cursor-pointer hover:bg-blue-900 hover:text-blue-200">
                            <div x-text="`${result.city} (${result.code})`"></div>
                            <div class="text-xs text-gray-400" x-text="`(${result.code}) - ${result.name}, ${result.country}`"></div>
                        </div>
                    </template>
                    <div x-show="results.length === 0 && searchTerm.length > 1" class="px-4 py-2 text-gray-400">No results</div>
                </div>
            </div>

            <!-- Departure Time -->
            <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                <x-airport-search-input 
                    id="departure-time"
                    name="departure-time"
                    type="text"
                    class="w-full form-control py-4 px-5 sm:rounded-bl-lg lg:rounded-bl-none"
                    placeholder="Departure Time"
                    autocomplete="off"
                    x-model="searchTerm"
                />
            </div>

            <!-- Arrival Time -->
            <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                <x-airport-search-input 
                    id="arrival-time"
                    name="arrival-time"
                    type="text"
                    class="w-full form-control py-4 px-5 rounded-b-lg sm:rounded-b-none sm:rounded-br-lg lg:rounded-r-xl"
                    placeholder="Arrival Time"
                    autocomplete="off"
                    x-model="searchTerm"
                />
            </div>
            <div class="sm:col-span-2 lg:col-span-1 lg:ml-2 h-full">
                <x-search-button
                type="submit" 
                class="btn btn-primary h-full w-full">
                    Search
                </x-search-button>
            </div>
        </div>
    </form> 
</div>