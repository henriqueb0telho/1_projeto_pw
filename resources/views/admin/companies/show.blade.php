<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.companies.index') }}"
                               class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detalhes da Empresa</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Informações e propriedades associadas</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                ID: <span class="font-mono text-gray-700 dark:text-gray-300">#{{ $company->id }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                            <div class="p-6 bg-gradient-to-r from-pine/10 to-mint/10 dark:from-pine/20 dark:to-mint/20">
                                <div class="flex items-center gap-4">
                                    <div class="h-20 w-20 rounded-full bg-gradient-to-br from-mint to-lagoon flex items-center justify-center border-4 border-white dark:border-gray-800 shadow-lg text-white">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        <h2 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">{{ $company->name }}</h2>
                                        @if($company->nif)
                                            <div class="text-sm text-gray-600 dark:text-gray-300 mt-1">NIF: {{ $company->nif }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                @if($company->email)
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Email</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $company->email }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if($company->phone)
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Telefone</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $company->phone }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if($company->address)
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Morada</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $company->address }}</div>
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
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Data de Registo</div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $company->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <a href="{{ route('admin.companies.edit', $company) }}"
                                   class="w-full px-3 py-2 bg-mint hover:bg-lagoon text-white rounded-lg font-medium transition-all duration-200 text-center text-sm flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar Dados
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Alojamentos</div>
                                    <div class="p-2 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                        <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $company->accommodations_count }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Propriedades associadas</div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Utilizadores</div>
                                    <div class="p-2 bg-sage/10 dark:bg-sage/20 rounded-lg">
                                        <svg class="w-5 h-5 text-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $company->users_count }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Membros de equipa</div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Alojamentos Recentes</h3>
                                <a href="{{ route('admin.accommodations.index', ['company_id' => $company->id]) }}" class="text-sm text-mint hover:text-lagoon">Ver todos &rarr;</a>
                            </div>
                            <div class="p-6">
                                @if($company->accommodations && $company->accommodations->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($company->accommodations as $accommodation)
                                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 dark:hover:bg-gray-900/50 rounded-lg transition-colors border border-gray-100 dark:border-gray-700">
                                                <div class="flex items-center gap-3">
                                                    <div class="p-2 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                                        <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $accommodation->name }}
                                                        </div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ Str::limit($accommodation->address, 40) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('admin.accommodations.show', $accommodation) }}" class="text-gray-400 hover:text-gray-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <div class="w-16 h-16 mx-auto bg-gray-100 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400">Nenhum alojamento associado</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-red-200 dark:border-red-800 overflow-hidden">
                            <div class="px-6 py-4 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/30">
                                <h3 class="text-lg font-semibold text-red-800 dark:text-red-300">Zona de Perigo</h3>
                                <p class="text-sm text-red-700 dark:text-red-400 mt-1">Ações irreversíveis</p>
                            </div>

                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Eliminar Empresa</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            Esta ação eliminará permanentemente a empresa. Só permitido se não houver alojamentos/utilizadores.
                                        </p>
                                    </div>

                                    <form action="{{ route('admin.companies.destroy', $company) }}"
                                          method="POST"
                                          onsubmit="return confirm('Tem certeza que deseja eliminar permanentemente esta empresa?')"
                                          class="flex-shrink-0">
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
</x-app-layout>
