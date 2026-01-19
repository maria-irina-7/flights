<!-- Search Form -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight py-4">
    <form 
        method="POST" 
        action="{{ route('flights.search') }}" 
        class="">
        @csrf
        <div class="grid sm:grid-cols-2 lg:grid-cols-9 items-center gap-1">
            <div class="w-full h-full sm:col-span-2 lg:col-span-4 grid sm:grid-cols-2 lg:grid-cols-4 gap-1">
                <div x-data="{isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                    <x-airport-search-input
                        id="origin"
                        name="origin"
                        type="text"
                        class="w-full form-control py-4 px-5 rounded-t-3xl sm:rounded-t-none sm:rounded-tl-3xl lg:rounded-l-full"
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
                    <div x-show="isOpen" class="absolute w-full mt-1 bg-slate-900 border border-gray-700 rounded-b-lg lg:rounded-lg shadow-lg z-50 max-h-60 overflow-auto text-white">
                        <template x-for="result in results" :key="result.id">
                            <div @mousedown.prevent="searchTerm = result.code; isOpen = false; $el.blur();" class="px-4 py-2 cursor-pointer hover:bg-blue-900 hover:text-blue-200">
                                <div x-text="`${result.city} (${result.code})`"></div>
                                <div class="text-xs text-gray-400" x-text="`${result.country} - ${result.name}`"></div>
                            </div>
                        </template>
                        <div x-show="results.length === 0 && searchTerm.length > 1" class="px-4 py-2 text-gray-400">No results</div>
                    </div>
                </div>

                <div class="text-slate-800 flex items-center py-2 sm:absolute sm:left-1/2 sm:-translate-x-1/2 lg:left-1/4 lg:-translate-x-1/4 lg:ml-6 sm:mt-2 sm:z-10 sm:rounded-full sm:w-10 sm:h-10 sm:border-slate-900 sm:border-4 bg-white ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 w-full">
                        <path fill-rule="evenodd" d="M13.2 2.24a.75.75 0 0 0 .04 1.06l2.1 1.95H6.75a.75.75 0 0 0 0 1.5h8.59l-2.1 1.95a.75.75 0 1 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 0 0-1.06.04Zm-6.4 8a.75.75 0 0 0-1.06-.04l-3.5 3.25a.75.75 0 0 0 0 1.1l3.5 3.25a.75.75 0 1 0 1.02-1.1l-2.1-1.95h8.59a.75.75 0 0 0 0-1.5H4.66l2.1-1.95a.75.75 0 0 0 .04-1.06Z" clip-rule="evenodd" />
                    </svg>

                </div>

                <!-- Destination Airport -->
                <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                    <x-airport-search-input 
                        id="destination"
                        name="destination"
                        type="text"
                        class="w-full form-control py-4 pl-8 pr-5 sm:rounded-tr-3xl lg:rounded-tr-none"
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
            </div>

            <!-- Departure Time -->
            <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                <x-airport-search-input 
                    id="departure-time"
                    name="departure-time"
                    type="text"
                    class="w-full form-control py-4 px-5 lg:rounded-bl-none"
                    placeholder="Departure Time"
                    autocomplete="off"
                    x-model="searchTerm"
                />
            </div>

            <!-- Number of Passengers -->
            <div x-data="{ isOpen: false, results: [], searchTerm: '' }" class="relative w-full lg:col-span-2" @click.away="isOpen = false">
                <x-airport-search-input 
                    id="passengers"
                    name="passengers"
                    type="text"
                    class="w-full form-control py-4 pl-8 lg:pl-5 pr-5 rounded-b-3xl sm:rounded-b-none lg:rounded-r-full"
                    placeholder="Number of Passengers"
                    autocomplete="off"
                    x-model="searchTerm"
                />
            </div>
            <div class="sm:col-span-2 lg:col-span-1 lg:ml-1 h-full">
                <x-search-button
                type="submit" 
                class="btn btn-primary h-full w-full sm:rounded-b-3xl sm:rounded-t-none lg:rounded-full">
                    Search
                </x-search-button>
            </div>
        </div>
    </form> 
</div>