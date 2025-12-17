<x-layouts.app title="Lista de Servidores">

    <div class="mx-auto px-4 py-4 md:py-6">
        <!-- Header -->
        <div class="bg-base-100 rounded-lg mb-4">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-accent dark:text-amber-600">{{ $entidade->nome }}
                    </h1>
                    <p class="text-sm text-base-content/60 mt-1">{{ $entidade->cnpj }}</p>
                </div>
                <div class="badge badge-xl text-2xl badge-accent mt-2 md:mt-0 dark:rounded-full">
                    <svg class="size-5 text-primary dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Lista de Servidores
                </div>
            </div>
        </div>

        <!-- Table Component -->
        <livewire:folha.table :entidade_id="$entidade->id" />

    </div>
</x-layouts.app>