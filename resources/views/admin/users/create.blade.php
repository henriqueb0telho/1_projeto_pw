<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.users.index') }}"
                               class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Novo Utilizador</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Crie uma nova conta de utilizador</p>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="flex items-center gap-4">
                            <div class="text-right hidden md:block">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Total de utilizadores</div>
                                <div class="text-lg font-bold text-mint">{{ \App\Models\User::count() }}</div>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-mint/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Steps Indicator -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm mb-6">
                        <div class="flex items-center justify-center">
                            <div class="flex items-center">
                                <!-- Step 1 -->
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-mint flex items-center justify-center">
                                        <span class="text-white font-bold">1</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Informações Básicas</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Nome, email e cargo</div>
                                    </div>
                                </div>

                                <!-- Separator -->
                                <div class="w-16 h-0.5 bg-gray-300 dark:bg-gray-600 mx-4"></div>

                                <!-- Step 2 -->
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-600 dark:text-gray-400 font-bold">2</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">Detalhes Adicionais</div>
                                        <div class="text-xs text-gray-400 dark:text-gray-500">Empresa e contacto</div>
                                    </div>
                                </div>

                                <!-- Separator -->
                                <div class="w-16 h-0.5 bg-gray-300 dark:bg-gray-600 mx-4"></div>

                                <!-- Step 3 -->
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-600 dark:text-gray-400 font-bold">3</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">Configuração</div>
                                        <div class="text-xs text-gray-400 dark:text-gray-500">Password e estado</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Form -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <!-- Form Header -->
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Criar Novo Utilizador</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Preencha todos os campos obrigatórios (*)</p>
                    </div>

                    <!-- Form Content -->
                    <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-6">
                        @csrf

                        <!-- Success/Error Messages -->
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

                        <!-- Basic Information Section -->
                        <div class="space-y-4">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-2 h-6 bg-mint rounded"></div>
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Informações Básicas</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- First Name -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Primeiro Nome *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               id="first_name"
                                               name="first_name"
                                               value="{{ old('first_name') }}"
                                               required
                                               placeholder="Ex: João"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Último Nome *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               id="last_name"
                                               name="last_name"
                                               value="{{ old('last_name') }}"
                                               required
                                               placeholder="Ex: Silva"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="md:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Email *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <input type="email"
                                               id="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               required
                                               placeholder="Ex: joao.silva@exemplo.com"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">O utilizador usará este email para fazer login</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Role Section -->
                        <div class="space-y-4 pt-6">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-2 h-6 bg-lagoon rounded"></div>
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Contacto e Cargo</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Telefone
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               id="phone"
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               placeholder="Ex: +351 912 345 678"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Cargo *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <select id="role"
                                                name="role"
                                                required
                                                class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150 appearance-none">
                                            <option value="">Selecione o cargo</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>👑 Administrador</option>
                                            <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>💼 Gestor</option>
                                            <option value="cleaner" {{ old('role') == 'cleaner' ? 'selected' : '' }}>🧹 Cleaner</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Company -->
                                <div>
                                    <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Empresa
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
                                            <option value="">Sem empresa</option>
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

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Estado *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        <select id="status"
                                                name="status"
                                                required
                                                class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150 appearance-none">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>✅ Ativo (acesso imediato)</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>⏸️ Inativo (sem acesso)</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Endereço
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
                                              rows="3"
                                              placeholder="Ex: Rua Principal, 123 - Lisboa"
                                              class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="space-y-4 pt-6">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-2 h-6 bg-sage rounded"></div>
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Segurança e Acesso</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Password *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        <input type="password"
                                               id="password"
                                               name="password"
                                               required
                                               placeholder="Mínimo 8 caracteres"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                    <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        A password deve ter pelo menos 8 caracteres
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Confirmar Password *
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        <input type="password"
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               required
                                               placeholder="Repita a password"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>
                            </div>

                            <!-- Password Requirements -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                <h5 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Requisitos de segurança:</h5>
                                <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Mínimo 8 caracteres
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Letras maiúsculas e minúsculas
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Números ou símbolos recomendados
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row justify-between gap-4 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <!-- Cancel Button -->
                            <a href="{{ route('admin.users.index') }}"
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </a>

                            <!-- Submit Button -->
                            <div class="flex gap-3">
                                <!-- Preview Button -->
                                <button type="button"
                                        onclick="previewUser()"
                                        class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Pré-visualizar
                                </button>

                                <!-- Create Button -->
                                <button type="submit"
                                        class="px-4 py-2.5 bg-mint hover:bg-lagoon text-white rounded-lg font-bold shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2 group">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Criar Utilizador
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Quick Help -->
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
                                <div class="text-mint font-bold mb-2">👑 Administrador</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Acesso completo a todas as funcionalidades do sistema.
                                </p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <div class="text-lagoon font-bold mb-2">💼 Gestor</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Pode gerir cleaners e agendar limpezas, mas sem acesso ao admin.
                                </p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <div class="text-sage font-bold mb-2">🧹 Cleaner</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Apenas visualiza e executa as limpezas atribuídas.
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
                                        Um email de confirmação será enviado ao novo utilizador com as instruções de acesso.
                                        Certifique-se de que o email está correto.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Preview -->
    <script>
        function previewUser() {
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;
            const email = document.getElementById('email').value;
            const role = document.getElementById('role').value;
            const status = document.getElementById('status').value;

            let roleText = '';
            let statusText = '';

            switch(role) {
                case 'admin': roleText = '👑 Administrador'; break;
                case 'manager': roleText = '💼 Gestor'; break;
                case 'cleaner': roleText = '🧹 Cleaner'; break;
                default: roleText = 'Não definido';
            }

            switch(status) {
                case 'active': statusText = '✅ Ativo'; break;
                case 'inactive': statusText = '⏸️ Inativo'; break;
                default: statusText = 'Não definido';
            }

            const message = `
📋 **Pré-visualização do Utilizador:**

👤 **Nome:** ${firstName || '[Não preenchido]'} ${lastName || '[Não preenchido]'}
📧 **Email:** ${email || '[Não preenchido]'}
🎯 **Cargo:** ${roleText}
📊 **Estado:** ${statusText}

*Esta é apenas uma pré-visualização. Clique em "Criar Utilizador" para confirmar.*
            `;

            alert(message);
        }

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('As passwords não coincidem! Por favor, verifique.');
                    return false;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    alert('A password deve ter pelo menos 8 caracteres!');
                    return false;
                }

                return true;
            });
        });
    </script>
</x-app-layout>
