<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-6">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-xl">
                                    <svg class="w-7 h-7 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Painel de Gestão</h1>
                                    <p class="text-gray-600 dark:text-gray-400 mt-1">Gestão Operacional da Empresa</p>
                                </div>
                            </div>

                            <!-- Status Indicator -->
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-mint/5 dark:bg-mint/10 rounded-lg border border-mint/20 dark:border-mint/30">
                                <div class="w-2 h-2 bg-mint rounded-full"></div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ now()->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="#" class="px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium shadow-sm hover:shadow-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center gap-2 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Gerir Equipa
                            </a>
                            <a href="#" class="px-4 py-3 bg-mint hover:bg-lagoon text-white rounded-lg font-bold shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Nova Limpeza
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KPI Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <!-- Cleanings Today -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Limpezas Hoje</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['cleanings_today'] }}</p>
                            </div>
                            <div class="p-3 bg-pine/10 dark:bg-pine/20 rounded-lg">
                                <svg class="w-6 h-6 text-pine dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">agendadas para hoje</p>
                        </div>
                    </div>

                    <!-- Active Team -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Equipa Ativa</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_cleaners'] }}</p>
                            </div>
                            <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                <svg class="w-6 h-6 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">cleaners disponíveis</p>
                        </div>
                    </div>

                    <!-- Issues -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Atenção Necessária</p>
                                <p class="text-3xl font-bold text-red-600 dark:text-red-500 mt-2">{{ $stats['pending_issues'] }}</p>
                            </div>
                            <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">atrasos a resolver</p>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Today's Agenda -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                Agenda de Hoje
                                <span class="text-xs font-medium bg-pine text-white px-3 py-1 rounded-full">
                                    {{ \Carbon\Carbon::today()->format('d/m') }}
                                </span>
                            </h2>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $todaysCleanings->count() }} tarefas</span>
                        </div>

                        @if($todaysCleanings->count() > 0)
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                                @foreach($todaysCleanings as $cleaning)
                                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 last:border-0 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors duration-200">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div class="relative">
                                                    <div class="w-3 h-3 rounded-full
                                                        {{ $cleaning->status === 'completed' ? 'bg-mint' :
                                                           ($cleaning->status === 'in_progress' ? 'bg-yellow-500 animate-pulse' : 'bg-gray-400') }}">
                                                    </div>
                                                    @if($cleaning->status === 'in_progress')
                                                        <div class="absolute -inset-1 bg-yellow-500/20 rounded-full animate-ping"></div>
                                                    @endif
                                                </div>

                                                <div>
                                                    <h3 class="font-bold text-gray-900 dark:text-white">{{ $cleaning->accommodation->name }}</h3>
                                                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            {{ \Carbon\Carbon::parse($cleaning->scheduled_time)->format('H:i') }}
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                            </svg>
                                                            {{ $cleaning->users->pluck('first_name')->join(', ') ?: 'Sem staff' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <span class="px-3 py-1.5 rounded-full text-xs font-bold
                                                    {{ $cleaning->status === 'completed' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' :
                                                       ($cleaning->status === 'in_progress' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300' :
                                                        'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400') }}">
                                                    {{ match($cleaning->status) {
                                                        'scheduled' => 'Pendente',
                                                        'in_progress' => 'A decorrer',
                                                        'completed' => 'Concluído',
                                                        default => $cleaning->status
                                                    } }}
                                                </span>
                                                <div class="mt-2">
                                                    <a href="#" class="text-xs text-pine dark:text-mint hover:underline font-medium hover:text-lagoon dark:hover:text-lagoon transition-colors">
                                                        Editar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-8 text-center">
                                <div class="w-16 h-16 mx-auto bg-gray-100 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Dia tranquilo!</h3>
                                <p class="text-gray-600 dark:text-gray-400 max-w-sm mx-auto">
                                    Não há limpezas agendadas para hoje. Aproveite para planear a próxima semana.
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Upcoming Days -->
                    <div class="space-y-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="font-bold text-gray-900 dark:text-white">Próximos Dias</h3>
                                <span class="text-xs font-medium bg-mint/10 dark:bg-mint/20 text-mint px-3 py-1 rounded-full">
                                    {{ $upcomingCleanings->count() }} tarefas
                                </span>
                            </div>

                            <div class="space-y-5">
                                @foreach($upcomingCleanings as $next)
                                    <div class="flex justify-between items-center group hover:bg-gray-50 dark:hover:bg-gray-900/50 p-3 -mx-3 rounded-lg transition-colors duration-200">
                                        <div class="flex items-start gap-3">
                                            <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-mint group-hover:scale-125 transition-transform"></div>
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-white group-hover:text-mint transition-colors">{{ $next->accommodation->name }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2 mt-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($next->scheduled_date)->format('d/m') }}
                                                    <span class="text-gray-300 dark:text-gray-600">•</span>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($next->scheduled_time)->format('H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-300 dark:text-gray-600 group-hover:text-mint transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-700 text-center">
                                <a href="#" class="text-sm text-pine dark:text-mint font-medium hover:text-lagoon dark:hover:text-lagoon transition-colors inline-flex items-center gap-1 group">
                                    Ver Calendário Completo
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Stats -->
                @if($todaysCleanings->count() > 0)
                    <div class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Resumo do Dia</p>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $todaysCleanings->where('status', 'scheduled')->count() }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Pendentes</div>
                                </div>
                                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="text-lg font-bold text-yellow-600 dark:text-yellow-500">{{ $todaysCleanings->where('status', 'in_progress')->count() }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Em Progresso</div>
                                </div>
                                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="text-lg font-bold text-mint">{{ $todaysCleanings->where('status', 'completed')->count() }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Concluídas</div>
                                </div>
                                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $todaysCleanings->count() }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Total Hoje</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
