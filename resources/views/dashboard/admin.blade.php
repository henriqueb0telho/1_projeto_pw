<x-app-layout>
    <div class="min-h-screen bg-[#1f2421] dark:bg-[#1f2421]">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#dce1de]">Admin Dashboard</h1>
                    <p class="text-[#9cc5a1] mt-2">Gestão Global da Plataforma</p>
                </div>

                <!-- KPI Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Companies -->
                    <div class="bg-[#216869] rounded-lg shadow-lg p-6 border border-[#358471]/30 hover:border-[#49a078] transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#9cc5a1] text-sm font-medium">Total Empresas</p>
                                <p class="text-3xl font-bold text-[#dce1de] mt-2">{{ $totalCompanies }}</p>
                            </div>
                            <div class="bg-[#358471] p-3 rounded-lg">
                                <svg class="w-8 h-8 text-[#49a078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-[#49a078] font-medium">{{ $activeCompanies }}</span>
                            <span class="text-[#9cc5a1] ml-2">empresas ativas</span>
                        </div>
                    </div>

                    <!-- Total Users -->
                    <div class="bg-[#216869] rounded-lg shadow-lg p-6 border border-[#358471]/30 hover:border-[#49a078] transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#9cc5a1] text-sm font-medium">Total Utilizadores</p>
                                <p class="text-3xl font-bold text-[#dce1de] mt-2">{{ $totalUsers }}</p>
                            </div>
                            <div class="bg-[#358471] p-3 rounded-lg">
                                <svg class="w-8 h-8 text-[#49a078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-[#9cc5a1]">
                            <span>{{ $managersCount }} managers · {{ $cleanersCount }} cleaners</span>
                        </div>
                    </div>

                    <!-- Total Accommodations -->
                    <div class="bg-[#216869] rounded-lg shadow-lg p-6 border border-[#358471]/30 hover:border-[#49a078] transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#9cc5a1] text-sm font-medium">Total Alojamentos</p>
                                <p class="text-3xl font-bold text-[#dce1de] mt-2">{{ $totalAccommodations }}</p>
                            </div>
                            <div class="bg-[#358471] p-3 rounded-lg">
                                <svg class="w-8 h-8 text-[#49a078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-[#9cc5a1]">
                            <span>Distribuídos por {{ $totalCompanies }} empresas</span>
                        </div>
                    </div>

                    <!-- Total Cleanings -->
                    <div class="bg-[#216869] rounded-lg shadow-lg p-6 border border-[#358471]/30 hover:border-[#49a078] transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#9cc5a1] text-sm font-medium">Limpezas (30 dias)</p>
                                <p class="text-3xl font-bold text-[#dce1de] mt-2">{{ $totalCleanings }}</p>
                            </div>
                            <div class="bg-[#358471] p-3 rounded-lg">
                                <svg class="w-8 h-8 text-[#49a078]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-[#49a078] font-medium">{{ $completedCleanings }}</span>
                            <span class="text-[#9cc5a1] ml-2">concluídas</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Activity -->
                    <div class="bg-[#216869] rounded-lg shadow-lg p-6 border border-[#358471]/30">
                        <h3 class="text-xl font-bold text-[#dce1de] mb-4">Atividade Recente</h3>
                        <div class="space-y-4">
                            @forelse($recentActivity as $activity)
                                <div class="flex items-start space-x-3 p-3 bg-[#1f2421] rounded-lg border border-[#358471]/20">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full bg-[#358471] flex items-center justify-center">
                                            <span class="text-[#49a078] font-bold">{{ substr($activity->company_name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-[#dce1de]">{{ $activity->company_name }}</p>
                                        <p class="text-sm text-[#9cc5a1]">{{ $activity->description }}</p>
                                        <p class="text-xs text-[#4f798c] mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-[#9cc5a1] text-center py-8">Nenhuma atividade recente</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Top Companies -->
                    <div class="bg-[#216869] rounded-lg shadow-lg p-6 border border-[#358471]/30">
                        <h3 class="text-xl font-bold text-[#dce1de] mb-4">Top Empresas (Limpezas)</h3>
                        <div class="space-y-4">
                            @forelse($topCompanies as $company)
                                <div class="flex items-center justify-between p-3 bg-[#1f2421] rounded-lg border border-[#358471]/20">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-[#358471] flex items-center justify-center">
                                            <span class="text-[#49a078] font-bold">{{ substr($company->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-[#dce1de]">{{ $company->name }}</p>
                                            <p class="text-xs text-[#9cc5a1]">{{ $company->accommodations_count }} alojamentos</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-[#49a078]">{{ $company->cleanings_count }}</p>
                                        <p class="text-xs text-[#9cc5a1]">limpezas</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-[#9cc5a1] text-center py-8">Nenhuma empresa registada</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="bg-[#216869] rounded-lg shadow-lg p-6 border border-[#358471]/30">
                    <h3 class="text-xl font-bold text-[#dce1de] mb-4">Estado do Sistema</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-[#1f2421] rounded-lg border border-[#49a078]/30">
                            <div class="flex items-center justify-between">
                                <span class="text-[#9cc5a1] text-sm">Taxa de Conclusão</span>
                                <span class="text-[#49a078] font-bold text-lg">{{ $completionRate }}%</span>
                            </div>
                            <div class="mt-2 bg-[#358471] rounded-full h-2">
                                <div class="bg-[#49a078] h-2 rounded-full" style="width: {{ $completionRate }}%"></div>
                            </div>
                        </div>
                        <div class="p-4 bg-[#1f2421] rounded-lg border border-[#a38b4f]/30">
                            <div class="flex items-center justify-between">
                                <span class="text-[#9cc5a1] text-sm">Limpezas Agendadas</span>
                                <span class="text-[#a38b4f] font-bold text-lg">{{ $scheduledCleanings }}</span>
                            </div>
                            <p class="text-xs text-[#9cc5a1] mt-2">Próximos 7 dias</p>
                        </div>
                        <div class="p-4 bg-[#1f2421] rounded-lg border border-[#8c4f4f]/30">
                            <div class="flex items-center justify-between">
                                <span class="text-[#9cc5a1] text-sm">Pedidos Reagendamento</span>
                                <span class="text-[#8c4f4f] font-bold text-lg">{{ $rescheduleRequests }}</span>
                            </div>
                            <p class="text-xs text-[#9cc5a1] mt-2">Pendentes aprovação</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
