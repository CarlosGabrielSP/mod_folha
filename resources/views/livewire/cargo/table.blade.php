<div class="bg-base-100 rounded-lg border border-base-300 shadow-sm">
    <!-- Filters Section -->
    <div class="p-4 bg-base-200 border-b border-base-300">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-grow">
                <label class="block text-sm font-medium mb-1">Pesquisar</label>
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Buscar por nome ou referência..." class="input input-bordered w-full pr-10">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-base-content/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Per Page -->
            <div>
                <label class="block text-sm font-medium mb-1">Itens</label>
                <select wire:model.live="perPage" class="select select-bordered w-full">
                    @foreach ($perPageOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Table Section para Mobile -->
    <div class="md:hidden">
        @forelse ($cargos as $cargo)
            <div class="border-b border-base-300 p-4">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex flex-col">
                        <div class="font-medium text-lg">{{ $cargo->nome }}</div>
                        @if($cargo->referencia)
                            <div class="text-xs text-base-content">Referência: {{ $cargo->referencia }}</div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 mt-3">
                    <div>
                        <div class="text-xs text-base-content/60">Carga Horária</div>
                        <div class="font-semibold">{{ $cargo->carga_horaria ? $cargo->carga_horaria . 'h' : '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Salário Base</div>
                        <div class="font-semibold">
                            {{ $cargo->salario_base ? 'R$ ' . number_format($cargo->salario_base, 2, ',', '.') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="flex flex-col items-center gap-2 text-base-content/60">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="font-medium">Nenhum cargo encontrado</p>
                    <p class="text-sm">Tente ajustar os filtros de pesquisa</p>
                </div>
            </div>
        @endforelse
    </div>
    <!-- End Table Section para Mobile -->

    <!-- Table Section para Desktop -->
    <div class="hidden md:block overflow-x-auto">
        <table class="table table-zebra">
            <thead class="bg-neutral text-neutral-content">
                <tr>
                    <th wire:click="sortBy('nome')" class="cursor-pointer hover:bg-neutral-focus transition-colors">
                        <div class="flex items-center gap-2">
                            <span>CARGO</span>
                            @if($sortField === 'nome')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th wire:click="sortBy('referencia')"
                        class="cursor-pointer hover:bg-neutral-focus transition-colors">
                        <div class="flex items-center gap-2">
                            <span>REFERÊNCIA</span>
                            @if($sortField === 'referencia')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th wire:click="sortBy('carga_horaria')"
                        class="cursor-pointer hover:bg-neutral-focus transition-colors text-center">
                        <div class="flex items-center justify-center gap-2">
                            <span>CARGA HORÁRIA</span>
                            @if($sortField === 'carga_horaria')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th wire:click="sortBy('salario_base')"
                        class="cursor-pointer hover:bg-neutral-focus transition-colors text-right">
                        <div class="flex items-center justify-end gap-2">
                            <span>SALÁRIO BASE</span>
                            @if($sortField === 'salario_base')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                            @endif
                        </div>
                    </th>
                </tr>
            </thead>
            <thead class="bg-neutral/10">
                <tr>
                    <th><input type="text" wire:model.live.debounce.500ms="nome" placeholder="Pesquisar..."
                            class="input input-sm w-full">
                    </th>
                    <th><input type="text" wire:model.live.debounce.500ms="referencia" placeholder="Pesquisar..."
                            class="input input-sm w-full">
                    </th>
                    <th><input type="text" wire:model.live.debounce.500ms="carga_horaria" placeholder="Pesquisar..."
                            class="input input-sm w-full">
                    </th>
                    <th><input type="text" wire:model.live.debounce.500ms="salario_base" placeholder="Pesquisar..."
                            class="input input-sm w-full">
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cargos as $cargo)
                    <tr class="hover">
                        <td>
                            <div class="font-medium">{{ $cargo->nome }}</div>
                        </td>
                        <td>
                            <div>{{ $cargo->referencia ?? '-' }}</div>
                        </td>
                        <td class="text-center">
                            <div>{{ $cargo->carga_horaria ?? '-' }}</div>
                        </td>
                        <td class="text-right font-semibold">
                            {{ $cargo->salario_base ? 'R$ ' . number_format($cargo->salario_base, 2, ',', '.') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-12">
                            <div class="flex flex-col items-center gap-2 text-base-content/60">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p class="font-medium">Nenhum cargo encontrado</p>
                                <p class="text-sm">Tente ajustar os filtros de pesquisa</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- End Table Section para Desktop -->

    <!-- Pagination -->
    @if($cargos->count() > 0)
        <div class="p-4 bg-base-200 border-t border-base-300">
            <!-- Mobile Pagination -->
            <div class="md:hidden flex justify-between items-center">
                <div class="text-xs text-base-content/60">
                    {{ $cargos->firstItem() ?? 0 }}-{{ $cargos->lastItem() ?? 0 }} de {{ $cargos->total() }}
                </div>
                <div class="join">
                    @if ($cargos->onFirstPage())
                        <button class="join-item btn btn-sm btn-disabled">«</button>
                    @else
                        <button wire:click="previousPage" class="join-item btn btn-sm">«</button>
                    @endif

                    <button class="join-item btn btn-sm">{{ $cargos->currentPage() }}</button>

                    @if ($cargos->hasMorePages())
                        <button wire:click="nextPage" class="join-item btn btn-sm">»</button>
                    @else
                        <button class="join-item btn btn-sm btn-disabled">»</button>
                    @endif
                </div>
            </div>

            <!-- Desktop Pagination -->
            <div class="hidden md:flex md:flex-row justify-between items-center gap-4">
                <div class="text-sm text-base-content/60">
                    Página {{ $cargos->currentPage() }} de {{ $cargos->lastPage() }}
                </div>
                <div class="join">
                    @if ($cargos->onFirstPage())
                        <button class="join-item btn btn-disabled">Anterior</button>
                    @else
                        <button wire:click="previousPage" class="join-item btn">Anterior</button>
                    @endif

                    <button class="join-item btn btn-active">Página {{ $cargos->currentPage() }}</button>

                    @if ($cargos->hasMorePages())
                        <button wire:click="nextPage" class="join-item btn">Próximo</button>
                    @else
                        <button class="join-item btn btn-disabled">Próximo</button>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <!-- End Pagination -->
</div>