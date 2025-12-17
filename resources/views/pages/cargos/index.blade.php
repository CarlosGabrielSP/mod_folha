<x-layouts.app title="Plano de Cargos e Salários">

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
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>
                    Plano de Cargos e Salários
                </div>
            </div>
        </div>

        <!-- Table Component -->
        <livewire:cargo.table :entidade_id="$entidade->id" />

    </div>
</x-layouts.app>