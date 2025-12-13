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
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Novo Alojamento</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Registe uma nova propriedade no sistema</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-right hidden md:block">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Total de alojamentos</div>
                                <div class="text-lg font-bold text-mint">{{ \App\Models\Accommodation::count() }}</div>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-mint/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm mb-6">
                        <div class="flex items-center justify-center">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-mint flex items-center justify-center">
                                        <span class="text-white font-bold">1</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Informações Básicas</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Nome e Empresa</div>
                                    </div>
                                </div>

                                <div class="w-16 h-0.5 bg-gray-300 dark:bg-gray-600 mx-4"></div>

                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-600 dark:text-gray-400 font-bold">2</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">Localização</div>
                                        <div class="text-xs text-gray-400 dark:text-gray-500">Morada e Descrição</div>
                                    </div>
                                </div>

                                <div class="w-16 h-0.5 bg-gray-300 dark:bg-gray-600 mx-4"></div>

                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-600 dark:text-gray-400 font-bold">3</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">Capacidade</div>
                                        <div class="text-xs text-gray-400 dark:text-gray-500">Quartos e Hóspedes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Criar Novo Alojamento</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Preencha todos os campos obrigatórios (*)</p>
                    </div>

                    <form action="{{ route('admin.accommodations.store') }}" method="POST" class="p-6 space-y-6">
                        @csrf

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
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-2 h-6 bg-mint rounded"></div>
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Informações Básicas</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nome do Alojamento *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               id="name"
                                               name="name"
                                               value="{{ old('name') }}"
                                               required
                                               placeholder="Ex: Apartamento Vista Mar"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <div>
                                    <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Empresa Proprietária
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <select id="company_id"
                                                name="company_id"
                                                class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150 appearance-none">
                                            <option value="">Selecione uma empresa</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Estado *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        <select id="is_active"
                                                name="is_active"
                                                required
                                                class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150 appearance-none">
                                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>✅ Ativo (Visível)</option>
                                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>⏸️ Inativo (Oculto)</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 pt-6">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-2 h-6 bg-lagoon rounded"></div>
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Descrição e Localização</h4>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Descrição
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                        </svg>
                                    </div>
                                    <textarea id="description"
                                              name="description"
                                              rows="3"
                                              placeholder="Pequena descrição sobre o alojamento..."
                                              class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Morada Completa
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <textarea id="address"
                                              name="address"
                                              rows="2"
                                              placeholder="Ex: Rua das Flores, 123 - Lisboa"
                                              class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 pt-6">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-2 h-6 bg-sage rounded"></div>
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Capacidade e Configuração</h4>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <label for="max_guests" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Hóspedes *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="number"
                                               id="max_guests"
                                               name="max_guests"
                                               value="{{ old('max_guests', 1) }}"
                                               min="1"
                                               required
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <div>
                                    <label for="bedrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Quartos *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                        </div>
                                        <input type="number"
                                               id="bedrooms"
                                               name="bedrooms"
                                               value="{{ old('bedrooms', 1) }}"
                                               min="0"
                                               required
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <div>
                                    <label for="bathrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        WC *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                        </div>
                                        <input type="number"
                                               id="bathrooms"
                                               name="bathrooms"
                                               value="{{ old('bathrooms', 1) }}"
                                               min="0"
                                               required
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <div>
                                    <label for="cleaning_time_estimate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Limpeza (h) *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="number"
                                               step="0.5"
                                               id="cleaning_time_estimate"
                                               name="cleaning_time_estimate"
                                               value="{{ old('cleaning_time_estimate', 2.0) }}"
                                               min="0.5"
                                               required
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between gap-4 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('admin.accommodations.index') }}"
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </a>

                            <div class="flex gap-3">
                                <button type="button"
                                        onclick="previewAccommodation()"
                                        class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Pré-visualizar
                                </button>

                                <button type="submit"
                                        class="px-4 py-2.5 bg-mint hover:bg-lagoon text-white rounded-lg font-bold shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2 group">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Criar Alojamento
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-mint/20 dark:border-mint/30 overflow-hidden">
                    <div class="px-6 py-4 border-b border-mint/20 dark:border-mint/30 bg-mint/5 dark:bg-mint/10">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Dicas Rápidas
                        </h3>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <div class="text-mint font-bold mb-2">🏠 Alojamento</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Preencha o nome comercial que será visível para os clientes.
                                </p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <div class="text-lagoon font-bold mb-2">⏱️ Limpeza</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Defina o tempo médio estimado para uma limpeza completa.
                                </p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <div class="text-sage font-bold mb-2">🏢 Empresa</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Associe o alojamento a uma empresa responsável.
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <div>
                                    <div class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Importante</div>
                                    <p class="text-sm text-yellow-700 dark:text-yellow-400 mt-1">
                                        Se definir o estado como "Inativo", o alojamento não aparecerá para agendamento de limpezas ou para os cleaners.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewAccommodation() {
            const name = document.getElementById('name').value;
            const companySelect = document.getElementById('company_id');
            const company = companySelect.options[companySelect.selectedIndex]?.text || 'N/A';
            const guests = document.getElementById('max_guests').value;
            const status = document.getElementById('is_active').value;

            let statusText = '';
            if (status == '1') statusText = '✅ Ativo';
            else if (status == '0') statusText = '⏸️ Inativo';
            else statusText = 'Não definido';

            const message = `
📋 **Pré-visualização do Alojamento:**

🏠 **Nome:** ${name || '[Não preenchido]'}
🏢 **Empresa:** ${company}
👥 **Capacidade:** ${guests} Hóspedes
📊 **Estado:** ${statusText}

*Esta é apenas uma pré-visualização. Clique em "Criar Alojamento" para confirmar.*
            `;

            alert(message);
        }
    </script>
</x-app-layout>
