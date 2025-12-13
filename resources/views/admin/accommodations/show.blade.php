<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.accommodations.index') }}"
                               class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detalhes do Alojamento</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Informações completas e histórico</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                ID: <span class="font-mono text-gray-700 dark:text-gray-300">#{{ $accommodation->id }}</span>
                            </span>
                            <div class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Criado em: {{ $accommodation->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                            <div class="p-6 bg-gradient-to-r from-pine/10 to-mint/10 dark:from-pine/20 dark:to-mint/20">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div class="h-20 w-20 rounded-full bg-gradient-to-br from-mint to-lagoon flex items-center justify-center border-4 border-white dark:border-gray-800 shadow-lg text-white">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                        </div>
                                        <div class="absolute bottom-1 right-1">
                                            <div class="w-4 h-4 rounded-full border-2 border-white dark:border-gray-800
                                                {{ $accommodation->is_active ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <h2 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">{{ $accommodation->name }}</h2>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $accommodation->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' :
                                                   'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                                                {{ $accommodation->is_active ? 'Ativo' : 'Inativo' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Empresa</div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $accommodation->company ? $accommodation->company->name : 'Sem empresa associada' }}
                                        </div>
                                    </div>
                                </div>

                                @if($accommodation->address)
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Morada</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $accommodation->address }}</div>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Última atualização</div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $accommodation->updated_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.accommodations.edit', $accommodation) }}"
                                       class="flex-1 px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 text-center text-sm flex items-center justify-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.accommodations.toggle-status', $accommodation) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="w-full px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition-all duration-200 text-sm flex items-center justify-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($accommodation->is_active)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                @endif
                                            </svg>
                                            {{ $accommodation->is_active ? 'Desativar' : 'Ativar' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Metadados</h3>
                            </div>
                            <div class="p-6 space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Total Limpezas</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $accommodation->cleaningSchedules ? $accommodation->cleaningSchedules->count() : 0 }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Criado em</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $accommodation->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Capacidade</div>
                                    <div class="p-2 bg-pine/10 dark:bg-pine/20 rounded-lg">
                                        <svg class="w-5 h-5 text-pine dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $accommodation->max_guests }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hóspedes máx.</div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Quartos</div>
                                    <div class="p-2 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                        <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold text-mint">{{ $accommodation->bedrooms }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Dormitórios</div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">WC</div>
                                    <div class="p-2 bg-lagoon/10 dark:bg-lagoon/20 rounded-lg">
                                        <svg class="w-5 h-5 text-lagoon dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold text-lagoon">{{ $accommodation->bathrooms }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Casas de banho</div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Limpeza</div>
                                    <div class="p-2 bg-sage/10 dark:bg-sage/20 rounded-lg">
                                        <svg class="w-5 h-5 text-sage dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold text-sage dark:text-mint">{{ $accommodation->cleaning_time_estimate }}h</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Estimativa</div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sobre a Propriedade</h3>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                                    {{ $accommodation->description ?: 'Nenhuma descrição fornecida para este alojamento.' }}
                                </p>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Próximas Limpezas</h3>
                            </div>
                            <div class="p-6">
                                @if($accommodation->upcomingCleanings && $accommodation->upcomingCleanings->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($accommodation->upcomingCleanings as $cleaning)
                                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 dark:hover:bg-gray-900/50 rounded-lg transition-colors border border-gray-100 dark:border-gray-700">
                                                <div class="flex items-center gap-3">
                                                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $cleaning->scheduled_date->format('d/m/Y') }}
                                                        </div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $cleaning->scheduled_time ? $cleaning->scheduled_time->format('H:i') : 'Sem hora' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                    {{ $cleaning->status ?? 'Agendada' }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <div class="w-16 h-16 mx-auto bg-gray-100 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400">Nenhuma limpeza agendada proximamente</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-red-200 dark:border-red-800 overflow-hidden">
                            <div class="px-6 py-4 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/30">
                                <h3 class="text-lg font-semibold text-red-800 dark:text-red-300">Zona de Perigo</h3>
                                <p class="text-sm text-red-700 dark:text-red-400 mt-1">Ações irreversíveis - proceda com cautela</p>
                            </div>

                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Eliminar Alojamento</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            Esta ação eliminará permanentemente o alojamento e todos os dados associados. Não pode ser desfeita.
                                        </p>
                                    </div>

                                    <form action="{{ route('admin.accommodations.destroy', $accommodation) }}"
                                          method="POST"
                                          onsubmit="return confirm('Tem certeza que deseja eliminar permanentemente este alojamento? TODOS os dados associados serão perdidos.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Copy ID to clipboard
        function copyId() {
            const id = '{{ $accommodation->id }}';
            navigator.clipboard.writeText(id).then(() => {
                alert('ID copiado: ' + id);
            });
        }
    </script>
</x-app-layout>
