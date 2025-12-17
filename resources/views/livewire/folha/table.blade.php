<div class="bg-base-100 rounded-lg border border-base-300 shadow-sm">
    <!-- Filters Section -->
    <div class="p-4 bg-base-200 border-b border-base-300">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Month Filter -->
            <div>
                <label class="block text-sm font-medium mb-1">Período</label>
                <div class="relative">
                    <input type="month" wire:model.live="mes_ano" class="input input-bordered w-full pr-10"
                        placeholder="Selecione o mês">
                </div>
            </div>

            <!-- Search -->
            <div class="flex-grow">
                <label class="block text-sm font-medium mb-1">Pesquisar</label>
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Buscar por nome, cargo, lotação..." class="input input-bordered w-full pr-10">
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

    @if(!isset($mes_ano))
        <div class="text-center py-8">
            <p class="text-lg text-base-content">
                <svg class="w-12 h-12 mx-auto mb-4 text-base-content/40" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Selecione um Período para visualizar as informações</span>
            </p>
        </div>
    @else
        <!-- Table Section para Mobile -->
        <div class="md:hidden">
            @forelse ($despesas as $despesa)
                <div class="border-b border-base-300 p-4">
                    <div class="flex justify-between items-center mb-1">
                        <div class="flex flex-col">
                            <div class="font-medium">{{ $despesa->funcionario }}</div>
                            <div class="text-xs text-base-content/60 mb-2">{{ $despesa->vinculo?->label() }}</div>
                        </div>
                        <span class="badge badge-outline badge-sm">{{ $despesa->situacao?->label() }}</span>
                    </div>

                    <div class="text-sm">{{ $despesa->cargo?->nome }}</div>

                    <div class="grid grid-cols-3 gap-2 mt-3">
                        <div>
                            <div class="text-xs text-base-content/60">Proventos</div>
                            <div class="font-semibold">R$ {{ number_format($despesa->total_proventos, 2, ',', '.') }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-base-content/60">Descontos</div>
                            <div class="font-semibold">R$ {{ number_format($despesa->total_descontos, 2, ',', '.') }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-base-content/60">Total</div>
                            <div class="font-semibold">R$ {{ number_format($despesa->total_liquido, 2, ',', '.') }}</div>
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
                        <p class="font-medium">Nenhum registro encontrado</p>
                        <p class="text-sm">Tente ajustar os filtros de pesquisa</p>
                    </div>
                </div>
            @endforelse

            <!-- Mobile Totals -->
            <div class="bg-base-200 p-4">
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <div class="text-xs text-base-content/60">Proventos</div>
                        <div class="font-bold text-green-500 dark:text-green-400">R$
                            {{ number_format($total_proventos, 2, ',', '.') }}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Descontos</div>
                        <div class="font-bold text-error">R$ {{ number_format($total_descontos, 2, ',', '.') }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Total</div>
                        <div class="font-bold text-info">R$ {{ number_format($total_liquido, 2, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table Section para Mobile -->

        <!-- Table Section para Desktop -->
        <div class="hidden md:block overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead class="bg-neutral text-neutral-content">
                    <tr>
                        <th wire:click="sortBy('matricula')"
                            class="cursor-pointer hover:bg-neutral-focus transition-colors">
                            <div class="flex items-center gap-2">
                                <span>MATRÍCULA</span>
                                @if($sortField === 'matricula')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('funcionario')"
                            class="cursor-pointer hover:bg-neutral-focus transition-colors">
                            <div class="flex items-center gap-2">
                                <span>NOME</span>
                                @if($sortField === 'funcionario')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('vinculo')" class="cursor-pointer hover:bg-neutral-focus transition-colors">
                            <div class="flex items-center gap-2">
                                <span>VÍNCULO</span>
                                @if($sortField === 'vinculo')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th class="cursor-default">
                            <div class="flex items-center gap-2">
                                <span>CARGO</span>
                            </div>
                        </th>
                        <th wire:click="sortBy('lotacao')" class="cursor-pointer hover:bg-neutral-focus transition-colors">
                            <div class="flex items-center gap-2">
                                <span>LOTAÇÃO</span>
                                @if($sortField === 'lotacao')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('situacao')" class="cursor-pointer hover:bg-neutral-focus transition-colors">
                            <div class="flex items-center gap-2">
                                <span>SITUAÇÃO</span>
                                @if($sortField === 'situacao')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('total_proventos')"
                            class="cursor-pointer hover:bg-neutral-focus transition-colors text-right">
                            <div class="flex items-center justify-end gap-2">
                                <span>PROVENTOS</span>
                                @if($sortField === 'total_proventos')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('total_descontos')"
                            class="cursor-pointer hover:bg-neutral-focus transition-colors text-right">
                            <div class="flex items-center justify-end gap-2">
                                <span>DESCONTOS</span>
                                @if($sortField === 'total_descontos')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('total_liquido')"
                            class="cursor-pointer hover:bg-neutral-focus transition-colors text-right">
                            <div class="flex items-center justify-end gap-2">
                                <span>LÍQUIDO</span>
                                @if($sortField === 'total_liquido')
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
                        <th><input type="text" wire:model.live.debounce.500ms="matricula" placeholder="Pesquisar..."
                                class="input input-sm w-full">
                        </th>
                        <th><input type="text" wire:model.live.debounce.500ms="nome" placeholder="Pesquisar..."
                                class="input input-sm w-full">
                        </th>
                        <th>
                            <select wire:model.live="vinculo" class="select select-sm w-full">
                                <option selected value="">Todos</option>
                                @foreach ($vinculos as $v)
                                    <option value="{{ $v->value }}">{{ $v->label() }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <select wire:model.live="cargo" class="select select-sm w-full">
                                <option selected value="">Todos</option>
                                @foreach ($cargos as $id => $nome)
                                    <option value="{{ $id }}">{{ $nome }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th><input type="text" wire:model.live.debounce.500ms="lotacao" placeholder="Pesquisar..."
                                class="input input-sm w-full">
                        </th>
                        <th>
                            <select wire:model.live="situacao" class="select select-sm w-full">
                                <option selected value="">Todos</option>
                                @foreach ($situacoes as $s)
                                    <option value="{{ $s->value }}">{{ $s->label() }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th><input type="text" wire:model.live.debounce.500ms="proventos" placeholder="Pesquisar..."
                                class="input input-sm w-full">
                        </th>
                        <th><input type="text" wire:model.live.debounce.500ms="descontos" placeholder="Pesquisar..."
                                class="input input-sm w-full">
                        </th>
                        <th><input type="text" wire:model.live.debounce.500ms="liquido" placeholder="Pesquisar..."
                                class="input input-sm w-full">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($despesas as $despesa)
                        <tr class="hover">
                            <td class="font-mono text-sm">{{ $despesa->matricula }}</td>
                            <td>
                                <div class="font-medium">{{ $despesa->funcionario }}</div>
                            </td>
                            <td>
                                <div class="text-xs text-base-content/60">{{ $despesa->vinculo?->label() }}</div>
                            </td>
                            <td>
                                <div class="text-sm">{{ $despesa->cargo->nome }}</div>
                            </td>
                            <td>
                                <div class="text-sm">{{ $despesa->lotacao }}</div>
                            </td>
                            <td>
                                <span class="badge badge-outline badge-sm">{{ $despesa->situacao?->label() }}</span>
                            </td>
                            <td class="text-right font-semibold">
                                R$ {{ number_format($despesa->total_proventos, 2, ',', '.') }}
                            </td>
                            <td class="text-right font-semibold">
                                R$ {{ number_format($despesa->total_descontos, 2, ',', '.') }}
                            </td>
                            <td class="text-right font-semibold">
                                R$ {{ number_format($despesa->total_liquido, 2, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-12">
                                <div class="flex flex-col items-center gap-2 text-base-content/60">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="font-medium">Nenhum registro encontrado</p>
                                    <p class="text-sm">Tente ajustar os filtros de pesquisa</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-base-200 font-bold">
                    <tr>
                        <td colspan="6" class="text-right text-lg">Total</td>
                        <td class="text-right text-lg text-green-700">
                            R$ {{ number_format($total_proventos, 2, ',', '.') }}
                        </td>
                        <td class="text-right text-lg text-red-700">
                            R$ {{ number_format($total_descontos, 2, ',', '.') }}
                        </td>
                        <td class="text-right text-lg text-blue-700">
                            R$ {{ number_format($total_liquido, 2, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- End Table Section para Desktop -->

        <!-- Pagination -->
        @if($despesas->count() > 0)
            <div class="p-4 bg-base-200 border-t border-base-300">
                <!-- Mobile Pagination -->
                <div class="md:hidden flex justify-between items-center">
                    <div class="text-xs text-base-content/60">
                        {{ $despesas->firstItem() ?? 0 }}-{{ $despesas->lastItem() ?? 0 }} de {{ $despesas->total() }}
                    </div>
                    <div class="join">
                        @if ($despesas->onFirstPage())
                            <button class="join-item btn btn-sm btn-disabled">«</button>
                        @else
                            <button wire:click="previousPage" class="join-item btn btn-sm">«</button>
                        @endif

                        <button class="join-item btn btn-sm">{{ $despesas->currentPage() }}</button>

                        @if ($despesas->hasMorePages())
                            <button wire:click="nextPage" class="join-item btn btn-sm">»</button>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">»</button>
                        @endif
                    </div>
                </div>

                <!-- Desktop Pagination -->
                <div class="hidden md:flex md:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-base-content/60">
                        Página {{ $despesas->currentPage() }} de {{ $despesas->lastPage() }}
                    </div>
                    <div class="join">
                        @if ($despesas->onFirstPage())
                            <button class="join-item btn btn-disabled">Anterior</button>
                        @else
                            <button wire:click="previousPage" class="join-item btn">Anterior</button>
                        @endif

                        <button class="join-item btn btn-active">Página {{ $despesas->currentPage() }}</button>

                        @if ($despesas->hasMorePages())
                            <button wire:click="nextPage" class="join-item btn">Próximo</button>
                        @else
                            <button class="join-item btn btn-disabled">Próximo</button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <!-- End Pagination -->
    @endif
</div>