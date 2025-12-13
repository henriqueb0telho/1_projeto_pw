<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.accommodations.index') }}"
                               class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Alojamento</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Atualize os dados da propriedade</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $accommodation->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' :
                                   'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                                <span class="w-1.5 h-1.5 rounded-full mr-2 {{ $accommodation->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $accommodation->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm mb-6">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-16 w-16 rounded-full bg-mint/20 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $accommodation->name }}</h2>
                                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ Str::limit($accommodation->address, 30) }}
                                    </span>
                                    @if($accommodation->company)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-lagoon/20 text-lagoon">
                                            {{ $accommodation->company->name }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-500">
                                            Sem Empresa
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-sage/20 text-sage dark:text-mint">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        {{ $accommodation->max_guests }} Pax
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informações do Alojamento</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Atualize os dados abaixo e guarde as alterações</p>
                    </div>

                    <form action="{{ route('admin.accommodations.update', $accommodation) }}" method="POST" class="p-6 space-y-6">
                        @csrf
                        @method('PUT')

                        @if(session('success'))
                            <div class="p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-green-800 dark:text-green-300">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <span class="text-red-800 dark:text-red-300">Por favor, corrija os erros abaixo:</span>
                                </div>
                                <ul class="text-sm text-red-700 dark:text-red-400 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="space-y-4">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b pb-2">Informações Básicas</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nome do Alojamento *
                                    </label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $accommodation->name) }}"
                                           required
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                </div>

                                <div>
                                    <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Empresa Proprietária
                                    </label>
                                    <select id="company_id"
                                            name="company_id"
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                        <option value="">Selecione uma empresa</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ old('company_id', $accommodation->company_id) == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Estado *
                                    </label>
                                    <select id="is_active"
                                            name="is_active"
                                            required
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                        <option value="1" {{ old('is_active', $accommodation->is_active) == 1 ? 'selected' : '' }}>Ativo</option>
                                        <option value="0" {{ old('is_active', $accommodation->is_active) == 0 ? 'selected' : '' }}>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 pt-6">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b pb-2">Detalhes e Localização</h4>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Descrição
                                </label>
                                <textarea id="description"
                                          name="description"
                                          rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">{{ old('description', $accommodation->description) }}</textarea>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Morada Completa
                                </label>
                                <textarea id="address"
                                          name="address"
                                          rows="2"
                                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">{{ old('address', $accommodation->address) }}</textarea>
                            </div>
                        </div>

                        <div class="space-y-4 pt-6">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white border-b pb-2">Configuração</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Defina as capacidades e estimativas de limpeza
                            </p>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <label for="max_guests" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Hóspedes
                                    </label>
                                    <input type="number"
                                           id="max_guests"
                                           name="max_guests"
                                           value="{{ old('max_guests', $accommodation->max_guests) }}"
                                           min="1"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                </div>

                                <div>
                                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Quartos
                                    </label>
                                    <input type="number"
                                           id="bedrooms"
                                           name="bedrooms"
                                           value="{{ old('bedrooms', $accommodation->bedrooms) }}"
                                           min="0"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                </div>

                                <div>
                                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        WC
                                    </label>
                                    <input type="number"
                                           id="bathrooms"
                                           name="bathrooms"
                                           value="{{ old('bathrooms', $accommodation->bathrooms) }}"
                                           min="0"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                </div>

                                <div>
                                    <label for="cleaning_time_estimate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Limpeza (h)
                                    </label>
                                    <input type="number"
                                           step="0.5"
                                           id="cleaning_time_estimate"
                                           name="cleaning_time_estimate"
                                           value="{{ old('cleaning_time_estimate', $accommodation->cleaning_time_estimate) }}"
                                           min="0.5"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between gap-4 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.accommodations.show', $accommodation) }}"
                                   class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Ver Detalhes
                                </a>

                                <form action="{{ route('admin.accommodations.toggle-status', $accommodation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
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

                            <div class="flex gap-3">
                                <a href="{{ route('admin.accommodations.index') }}"
                                   class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                    Cancelar
                                </a>

                                <button type="submit"
                                        class="px-4 py-2.5 bg-mint hover:bg-lagoon text-white rounded-lg font-bold shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2 group">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Guardar Alterações
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-red-200 dark:border-red-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/30">
                        <h3 class="text-lg font-semibold text-red-800 dark:text-red-300">Zona de Perigo</h3>
                        <p class="text-sm text-red-700 dark:text-red-400 mt-1">Ações irreversíveis - proceda com cautela</p>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Eliminar Alojamento</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    Esta ação eliminará permanentemente o alojamento e todos os dados associados (limpezas, histórico). Esta ação não pode ser desfeita.
                                </p>
                            </div>

                            <form action="{{ route('admin.accommodations.destroy', $accommodation) }}"
                                  method="POST"
                                  onsubmit="return confirm('Tem certeza que deseja eliminar permanentemente este alojamento? Esta ação não pode ser desfeita.')"
                                  class="flex-shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Eliminar Alojamento
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
