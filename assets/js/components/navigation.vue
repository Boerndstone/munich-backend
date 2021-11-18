<template>
    <div>
        <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle text-black" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="">
                        <a href="{{ path('area_index') }}" class="flex items-center px-4 py-2 text-black transition-colors duration-200 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">Gebiete</a>
                    </li>
                    <li class="">
                        <a href="{{ path('rock_index') }}" class="flex items-center px-4 py-2 text-black transition-colors duration-200 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">Felsen</a>
                    </li>
                    <li class="">
                        <a href="{{ path('routes_index') }}" class="flex items-center px-4 py-2 text-black transition-colors duration-200 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">Touren</a>
                    </li>
                    <li class="">
                        <a href="https://www.munichclimbs.de/draw-topo/src/" target="_blank" class="flex items-center px-4 py-2 text-black transition-colors duration-200 transform dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">Topo erstellen</a>
                    </li>
                    <li class="">
                        <a 
                            href="{{ path('app_logout') }}" 
                            class="flex items-center mx-2 px-2 py-1 text-sm text-gray-700 dark:text-gray-200 font-medium rounded-md hover:bg-gray-300 dark:hover:bg-gray-700"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</template>

<script>
    export default ({
        name: 'Navigation',
    })
</script>