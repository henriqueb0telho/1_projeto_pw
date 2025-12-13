<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Clean Header -->
                <div class="mb-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-xl">
                            <svg class="w-7 h-7 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Admin Dashboard</h1>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Gestão Global da Plataforma</p>
                        </div>
                    </div>

                    <!-- Status Indicator -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-mint/5 dark:bg-mint/10 rounded-lg border border-mint/20 dark:border-mint/30">
                        <div class="w-2 h-2 bg-mint rounded-full"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Atualizado: {{ now()->format('d/m/Y H:i') }}
                        </span>
                    </div>
                </div>

                <!-- KPI Cards - Light/Dark -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <!-- Total Companies -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Empresas</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalCompanies }}</p>
                            </div>
                            <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                <svg class="w-6 h-6 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-sm">
                                <span class="text-mint font-medium">{{ $activeCompanies }}</span>
                                <span class="text-gray-500 dark:text-gray-400 ml-1">empresas ativas</span>
                            </p>
                        </div>
                    </div>

                    <!-- Total Users -->
                    <a href="{{ route('admin.users.index') }}">
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-shadow">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Utilizadores</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalUsers }}</p>
                                </div>
                                <div class="p-3 bg-pine/10 dark:bg-pine/30 rounded-lg">
                                    <svg class="w-6 h-6 text-pine dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">Managers: <span class="font-medium text-gray-900 dark:text-white">{{ $managersCount }}</span></span>
                                    <span class="text-gray-600 dark:text-gray-400">Cleaners: <span class="font-medium text-gray-900 dark:text-white">{{ $cleanersCount }}</span></span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Total Accommodations -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Alojamentos</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalAccommodations }}</p>
                            </div>
                            <div class="p-3 bg-lagoon/10 dark:bg-lagoon/30 rounded-lg">
                                <svg class="w-6 h-6 text-lagoon dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Distribuídos por {{ $totalCompanies }} empresas
                            </p>
                        </div>
                    </div>

                    <!-- Total Cleanings -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Limpezas (30 dias)</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalCleanings }}</p>
                            </div>
                            <div class="p-3 bg-sage/10 dark:bg-sage/20 rounded-lg">
                                <svg class="w-6 h-6 text-sage dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-sm">
                                <span class="text-mint font-medium">{{ $completedCleanings }}</span>
                                <span class="text-gray-500 dark:text-gray-400 ml-1">concluídas</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Activity -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atividade Recente</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 px-3 py-1 rounded-full">
                                {{ $recentActivity->count() }} registos
                            </span>
                        </div>

                        <div class="space-y-4">
                            @forelse($recentActivity as $activity)
                                <div class="p-4 rounded-lg border border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-lg bg-mint/10 dark:bg-mint/20 flex items-center justify-center">
                                                <span class="text-mint dark:text-mint font-medium">{{ substr($activity->company_name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-start mb-1">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $activity->company_name }}</p>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $activity->created_at->format('H:i') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $activity->description }}</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-12 h-12 mx-auto bg-gray-100 dark:bg-gray-900 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400">Nenhuma atividade recente</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Top Companies -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Top Empresas</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Baseado em limpezas</span>
                        </div>

                        <div class="space-y-4">
                            @forelse($topCompanies as $index => $company)
                                <div class="p-4 rounded-lg border border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded flex items-center justify-center text-sm font-semibold
                                                @if($index === 0) bg-gold text-white
                                                @elseif($index === 1) bg-steel text-white
                                                @elseif($index === 2) bg-pine text-white
                                                @else bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400 @endif">
                                                {{ $index + 1 }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $company->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $company->accommodations_count }} alojamentos</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-semibold text-mint">{{ $company->cleanings_count }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">limpezas</p>
                                        </div>
                                    </div>

                                    @if($index < 3)
                                        <div class="mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">
                                            <div class="flex items-center justify-between text-xs">
                                                <span class="text-gray-500 dark:text-gray-400">Posição {{ $index + 1 }}º</span>
                                                <span class="text-mint font-medium">Top performer</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-12 h-12 mx-auto bg-gray-100 dark:bg-gray-900 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400">Nenhuma empresa registada</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Estado do Sistema</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Completion Rate -->
                        <div class="p-5 rounded-lg border border-gray-100 dark:border-gray-700 bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-900/50">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Taxa de Conclusão</span>
                                <span class="text-2xl font-bold text-mint">{{ $completionRate }}%</span>
                            </div>
                            <div class="mb-3 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-mint h-2 rounded-full transition-all duration-500" style="width: {{ $completionRate }}%"></div>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                                <span>0%</span>
                                <span>100%</span>
                            </div>
                        </div>

                        <!-- Scheduled Cleanings -->
                        <div class="p-5 rounded-lg border border-gray-100 dark:border-gray-700 bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-900/50">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Limpezas Agendadas</span>
                                <span class="text-2xl font-bold text-gold">{{ $scheduledCleanings }}</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Próximos 7 dias</p>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Média: {{ ceil($scheduledCleanings / 7) }} por dia
                                </div>
                            </div>
                        </div>

                        <!-- Reschedule Requests -->
                        <div class="p-5 rounded-lg border border-gray-100 dark:border-gray-700 bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-900/50">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Reagendamentos</span>
                                <span class="text-2xl font-bold text-rust">{{ $rescheduleRequests }}</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Pendentes aprovação</p>
                            <button class="text-sm text-gray-700 dark:text-gray-300 hover:text-mint transition-colors flex items-center gap-1">
                                Ver pendentes
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Simple Footer -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                           Sistma de Gestão de Alojamentos Locais • v{{ config('app.version', '1.0.1a') }}
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-mint rounded-full"></div>
                                <span class="text-xs text-gray-600 dark:text-gray-400">Operacional</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-gold rounded-full"></div>
                                <span class="text-xs text-gray-600 dark:text-gray-400">Agendado</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-rust rounded-full"></div>
                                <span class="text-xs text-gray-600 dark:text-gray-400">Pendente</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
