<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-6">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-xl">
                                    <svg class="w-7 h-7 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Gestão de Empresas</h1>
                                    <p class="text-gray-600 dark:text-gray-400 mt-1">Administre os proprietários e entidades fiscais</p>
                                </div>
                            </div>

                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-mint/5 dark:bg-mint/10 rounded-lg border border-mint/20 dark:border-mint/30">
                                <div class="w-2 h-2 bg-mint rounded-full"></div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ now()->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('admin.companies.create') }}"
                               class="px-4 py-3 bg-mint hover:bg-lagoon text-white rounded-lg font-bold shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Nova Empresa
                            </a>
                            <a href="{{ route('admin.companies.export') }}"
                               class="px-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium shadow-sm hover:shadow-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center gap-2 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Exportar CSV
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Total Empresas</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total'] }}</p>
                            </div>
                            <div class="p-3 bg-pine/10 dark:bg-pine/20 rounded-lg">
                                <svg class="w-6 h-6 text-pine dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Total Alojamentos</p>
                                <p class="text-3xl font-bold text-mint mt-2">{{ $stats['total_accommodations'] }}</p>
                            </div>
                            <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                <svg class="w-6 h-6 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Média Aloj./Empresa</p>
                                <p class="text-3xl font-bold text-sage dark:text-mint mt-2">{{ $stats['avg_accommodations'] }}</p>
                            </div>
                            <div class="p-3 bg-sage/10 dark:bg-sage/20 rounded-lg">
                                <svg class="w-6 h-6 text-sage dark:text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8 shadow-sm">
                    <form method="GET" action="{{ route('admin.companies.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pesquisar</label>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nome, NIF, Email ou Morada..."
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ordenar por</label>
                                <select name="sort_by"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Data de Registo</option>
                                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nome</option>
                                    <option value="nif" {{ request('sort_by') == 'nif' ? 'selected' : '' }}>NIF</option>
                                    <option value="accommodations_count" {{ request('sort_by') == 'accommodations_count' ? 'selected' : '' }}>Qtd. Alojamentos</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                            <button type="submit"
                                    class="px-4 py-2 bg-mint hover:bg-lagoon text-white rounded-lg font-medium shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Aplicar Filtros
                            </button>

                            @if(request()->hasAny(['search', 'sort_by']))
                                <a href="{{ route('admin.companies.index') }}"
                                   class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 transition-colors">
                                    Limpar filtros
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Empresas ({{ $companies->total() }})</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Empresa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">NIF / Identificação</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Contactos</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Alojamentos</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ações</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($companies as $company)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-lg bg-mint/20 dark:bg-mint/30 flex items-center justify-center text-mint">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $company->name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ $company->address }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($company->nif)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 font-mono">
                                                {{ $company->nif }}
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400 dark:text-gray-500 italic">N/A</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col gap-1">
                                            @if($company->email)
                                                <span class="inline-flex items-center gap-1.5 text-xs text-gray-600 dark:text-gray-400">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                    {{ $company->email }}
                                                </span>
                                            @endif
                                            @if($company->phone)
                                                <span class="inline-flex items-center gap-1.5 text-xs text-gray-600 dark:text-gray-400">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                    {{ $company->phone }}
                                                </span>
                                            @endif
                                            @if(!$company->email && !$company->phone)
                                                <span class="text-xs text-gray-400 italic">Sem contactos</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-mint/10 text-mint border border-mint/20">
                                            {{ $company->accommodations_count }} Propriedades
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.companies.show', $company) }}"
                                               class="text-gray-600 dark:text-gray-400 hover:text-mint dark:hover:text-mint transition-colors p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
                                               title="Ver detalhes">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('admin.companies.edit', $company) }}"
                                               class="text-gray-600 dark:text-gray-400 hover:text-lagoon dark:hover:text-lagoon transition-colors p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
                                               title="Editar">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja eliminar esta empresa? A ação será bloqueada se existirem alojamentos associados.')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500 transition-colors p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
                                                        title="Eliminar">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-gray-500 dark:text-gray-400">
                                            <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            <p class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhuma empresa encontrada</p>
                                            <p class="mb-4">Tente ajustar os seus filtros de pesquisa</p>
                                            <a href="{{ route('admin.companies.create') }}" class="inline-flex items-center px-4 py-2 bg-mint hover:bg-lagoon text-white rounded-lg font-medium shadow-sm hover:shadow transition-all duration-200">
                                                Criar Primeira Empresa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($companies->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            {{ $companies->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
