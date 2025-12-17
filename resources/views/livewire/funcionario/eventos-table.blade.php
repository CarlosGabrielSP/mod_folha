<div>
    <!-- Filtros -->
    <div class="flex gap-2 mb-4">
        <button wire:click="$set('filter', 'todos')"
            class="btn btn-sm {{ $filter === 'todos' ? 'btn-primary' : 'btn-outline' }}">
            Todos
        </button>
        <button wire:click="$set('filter', 'proventos')"
            class="btn btn-sm {{ $filter === 'proventos' ? 'btn-success' : 'btn-outline' }}">
            Proventos
        </button>
        <button wire:click="$set('filter', 'descontos')"
            class="btn btn-sm {{ $filter === 'descontos' ? 'btn-error' : 'btn-outline' }}">
            Descontos
        </button>
    </div>

    <!-- Cards de Resumo -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="stats shadow bg-base-100">
            <div class="stat">
                <div class="stat-figure text-green-600 dark:text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <div class="stat-title">Total Proventos</div>
                <div class="stat-value text-green-700 dark:text-green-400 text-2xl">
                    R$ {{ number_format($total_proventos, 2, ',', '.') }}
                </div>
                <div class="stat-desc">{{ $proventos->count() }} evento(s)</div>
            </div>
        </div>

        <div class="stats shadow bg-base-100">
            <div class="stat">
                <div class="stat-figure text-red-600 dark:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                </div>
                <div class="stat-title">Total Descontos</div>
                <div class="stat-value text-red-700 dark:text-red-400 text-2xl">
                    R$ {{ number_format($total_descontos, 2, ',', '.') }}
                </div>
                <div class="stat-desc">{{ $descontos->count() }} evento(s)</div>
            </div>
        </div>

        <div class="stats shadow bg-base-100">
            <div class="stat">
                <div class="stat-figure text-blue-600 dark:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                </div>
                <div class="stat-title">Valor Líquido</div>
                <div class="stat-value text-blue-700 dark:text-blue-400 text-2xl">
                    R$ {{ number_format($total_liquido, 2, ',', '.') }}
                </div>
                <div class="stat-desc">Proventos - Descontos</div>
            </div>
        </div>
    </div>

    <!-- Tabela de Eventos -->
    <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
        <table class="table table-zebra">
            <thead class="bg-base-200">
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th class="text-right">Valor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($eventos as $evento)
                    <tr class="hover">
                        <td class="font-medium">{{ $evento->evento->nome }}</td>
                        <td>
                            @if ($evento->evento->referencia_tipo === 'PROVENTO')
                                <span class="badge badge-success badge-sm">Provento</span>
                            @else
                                <span class="badge badge-error badge-sm">Desconto</span>
                            @endif
                        </td>
                        <td
                            class="text-right font-semibold {{ $evento->evento->referencia_tipo === 'PROVENTO' ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400' }}">
                            R$ {{ number_format($evento->valor, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-12">
                            <div class="flex flex-col items-center gap-2 text-base-content/60">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p class="font-medium">Nenhum evento encontrado</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if ($eventos->count() > 0)
                <tfoot class="bg-base-200 font-bold">
                    <tr>
                        <td colspan="3" class="text-right text-lg">Total</td>
                        <td class="text-right text-lg text-blue-700 dark:text-blue-400">
                            R$ {{ number_format($total_liquido, 2, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>