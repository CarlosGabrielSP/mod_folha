<x-layouts.app title="Detalhes do Servidor">

    <div class="mx-auto px-4 py-4 md:py-6">
        <!-- Breadcrumb -->
        <div class="text-sm breadcrumbs mb-4">
            <ul>
                <li>
                    <a href="{{ route('folhas.show', $funcionario->entidade) }}" class="link link-hover">
                        {{ $funcionario->entidade->nome }}
                    </a>
                </li>
                <li>{{ $funcionario->nome }}</li>
                <li>{{ str_pad($despesa->folha->mes, 2, '0', STR_PAD_LEFT) }}/{{ $despesa->folha->ano }}</li>
            </ul>
        </div>

        <!-- Header do Funcionário -->
        <div class="bg-base-100 rounded-lg shadow p-6 mb-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl font-bold text-accent dark:text-amber-600 mb-2">
                        {{ $funcionario->nome }}
                    </h1>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="badge badge-outline">{{ $funcionario->matricula }}</span>
                        <span class="badge badge-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            {{ str_pad($despesa->folha->mes, 2, '0', STR_PAD_LEFT) }}/{{ $despesa->folha->ano }}
                        </span>
                        <span class="badge badge-outline badge-sm">{{ $funcionario->situacao->nome }}</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div>
                            <span class="text-base-content/60">Cargo:</span>
                            <span class="font-medium ml-2">{{ $funcionario->cargo->nome }}</span>
                        </div>
                        <div>
                            <span class="text-base-content/60">Lotação:</span>
                            <span class="font-medium ml-2">{{ $funcionario->lotacao->nome }}</span>
                        </div>
                        <div>
                            <span class="text-base-content/60">Vínculo:</span>
                            <span class="font-medium ml-2">{{ $funcionario->vinculo->nome }}</span>
                        </div>
                        <div>
                            <span class="text-base-content/60">Referência:</span>
                            <span class="font-medium ml-2">{{ $despesa->referencia }}</span>
                        </div>
                    </div>
                </div>

                <!-- Card de Resumo -->
                <div class="stats stats-vertical md:stats-horizontal shadow bg-base-200">
                    <div class="stat place-items-center">
                        <div class="stat-title text-xs">Proventos</div>
                        <div class="stat-value text-green-700 dark:text-green-400 text-xl">
                            R$ {{ number_format($despesa->total_proventos, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="stat place-items-center">
                        <div class="stat-title text-xs">Descontos</div>
                        <div class="stat-value text-red-700 dark:text-red-400 text-xl">
                            R$ {{ number_format($despesa->total_descontos, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="stat place-items-center">
                        <div class="stat-title text-xs">Líquido</div>
                        <div class="stat-value text-blue-700 dark:text-blue-400 text-xl">
                            R$ {{ number_format($despesa->total_liquido, 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Título da Seção de Eventos -->
        <div class="mb-4">
            <h2 class="text-xl font-bold text-base-content">Eventos Financeiros</h2>
            <p class="text-sm text-base-content/60">
                Detalhamento de proventos e descontos da folha de
                {{ str_pad($despesa->folha->mes, 2, '0', STR_PAD_LEFT) }}/{{ $despesa->folha->ano }}
            </p>
        </div>

        <!-- Componente Livewire de Eventos -->
        <livewire:funcionario.eventos-table :despesa_id="$despesa->id" />
    </div>

</x-layouts.app>