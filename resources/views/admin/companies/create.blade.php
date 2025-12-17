<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.companies.index') }}"
                               class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Nova Empresa</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Registe uma nova entidade no sistema</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-right hidden md:block">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Total de empresas</div>
                                <div class="text-lg font-bold text-mint">{{ \App\Models\Company::count() }}</div>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-mint/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
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
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Dados Fiscais</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Nome e NIF</div>
                                    </div>
                                </div>

                                <div class="w-16 h-0.5 bg-gray-300 dark:bg-gray-600 mx-4"></div>

                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-600 dark:text-gray-400 font-bold">2</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-600 dark:text-gray-400">Contactos</div>
                                        <div class="text-xs text-gray-400 dark:text-gray-500">Email e Telefone</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Criar Nova Empresa</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Preencha os dados da entidade</p>
                    </div>

                    <form action="{{ route('admin.companies.store') }}" method="POST" class="p-6 space-y-6">
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
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Identificação</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nome da Empresa
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               id="name"
                                               name="name"
                                               value="{{ old('name') }}"
                                               required
                                               placeholder="Ex: Minha Empresa de Alojamento Lda."
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <div>
                                    <label for="nif" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        NIF
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               id="nif"
                                               name="nif"
                                               value="{{ old('nif') }}"
                                               placeholder="Ex: 500123456"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 pt-6">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-2 h-6 bg-sage rounded"></div>
                                <h4 class="text-md font-semibold text-gray-900 dark:text-white">Contactos e Localização</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Email
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
                                               placeholder="contacto@empresa.pt"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Telefone
                                        <span class="text-red-500">*</span>
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
                                               placeholder="+351 912 345 678"
                                               class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" required>
                                        Morada
                                        <span class="text-red-500">*</span>
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
                                                  class="pl-10 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150"
                                                  required>{{ old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between gap-4 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('admin.companies.index') }}"
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </a>

                            <div class="flex gap-3">
                                <button type="button"
                                        onclick="previewCompany()"
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
                                    Criar Empresa
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <div class="text-mint font-bold mb-2">📄 NIF</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    O NIF deve ser único no sistema. Confirme que não existem duplicados.
                                </p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <div class="text-sage font-bold mb-2">📧 Contactos</div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Este email poderá ser usado para notificações automáticas no futuro.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewCompany() {
            const name = document.getElementById('name').value;
            const nif = document.getElementById('nif').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;

            const message = `
📋 **Pré-visualização da Empresa:**

🏢 **Nome:** ${name || '[Não preenchido]'}
🔢 **NIF:** ${nif || 'N/A'}
📧 **Email:** ${email || 'N/A'}
📞 **Telefone:** ${phone || 'N/A'}

*Esta é apenas uma pré-visualização. Clique em "Criar Empresa" para confirmar.*
            `;

            alert(message);
        }
    </script>
</x-app-layout>
