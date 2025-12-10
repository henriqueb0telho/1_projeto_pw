<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header with Back Button -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.users.index') }}"
                               class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Perfil do Utilizador</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Detalhes completos e estatísticas</p>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                ID: <span class="font-mono text-gray-700 dark:text-gray-300">#{{ $user->id }}</span>
                            </span>
                            <div class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Registo: {{ $user->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- User Profile Card -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Profile Info -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Profile Card -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                            <!-- Profile Header -->
                            <div class="p-6 bg-gradient-to-r from-pine/10 to-mint/10 dark:from-pine/20 dark:to-mint/20">
                                <div class="flex items-center gap-4">
                                    <!-- Profile Photo -->
                                    <div class="relative">
                                        @if($user->profile_photo_path)
                                            <img class="h-20 w-20 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-lg"
                                                 src="{{ $user->profile_photo_url }}"
                                                 alt="{{ $user->full_name }}">
                                        @else
                                            <div class="h-20 w-20 rounded-full bg-gradient-to-br from-mint to-lagoon flex items-center justify-center border-4 border-white dark:border-gray-800 shadow-lg">
                                                <span class="text-3xl text-white font-bold">{{ strtoupper(substr($user->first_name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                        <!-- Status Indicator -->
                                        <div class="absolute bottom-1 right-1">
                                            <div class="w-4 h-4 rounded-full border-2 border-white dark:border-gray-800
                                                {{ $user->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                        </div>
                                    </div>

                                    <!-- Name and Role -->
                                    <div class="flex-1">
                                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->full_name }}</h2>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $user->role === 'admin' ? 'bg-mint/20 text-mint' :
                                                   ($user->role === 'manager' ? 'bg-lagoon/20 text-lagoon' :
                                                   'bg-sage/20 text-sage dark:text-mint') }}">
                                                {{ match($user->role) {
                                                    'admin' => 'Administrador',
                                                    'manager' => 'Gestor',
                                                    'cleaner' => 'Cleaner',
                                                    default => $user->role
                                                } }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $user->status === 'active' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' :
                                                   'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                                                {{ $user->status === 'active' ? 'Ativo' : 'Inativo' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Details -->
                            <div class="p-6 space-y-4">
                                <!-- Email -->
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Email</div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->email }}</div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                @if($user->phone)
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Telefone</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->phone }}</div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Company -->
                                @if($user->company)
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Empresa</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->company->name }}</div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Created At -->
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Membro desde</div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $user->created_at->format('d/m/Y') }}
                                            <span class="text-gray-500 dark:text-gray-400">({{ $user->created_at->diffForHumans() }})</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Last Updated -->
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Última atualização</div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $user->updated_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Email Verified -->
                                @if($user->email_verified_at)
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Email verificado</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $user->email_verified_at->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Email não verificado</div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                Aguardando confirmação
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Profile Actions -->
                            <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="flex-1 px-3 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 text-center text-sm flex items-center justify-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="w-full px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition-all duration-200 text-sm flex items-center justify-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($user->status === 'active')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                @endif
                                            </svg>
                                            {{ $user->status === 'active' ? 'Desativar' : 'Ativar' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Address Card -->
                        @if($user->address)
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="p-2 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                        <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Endereço</h3>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $user->address }}</p>

                                @if($user->lat && $user->long)
                                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                        <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                            </svg>
                                            Coordenadas: {{ $user->lat }}, {{ $user->long }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Quick Stats -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Resumo</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Estado da conta</span>
                                    <span class="text-sm font-medium {{ $user->status === 'active' ? 'text-green-600 dark:text-green-500' : 'text-red-600 dark:text-red-500' }}">
                                        {{ $user->status === 'active' ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Verificação de email</span>
                                    <span class="text-sm font-medium {{ $user->email_verified_at ? 'text-green-600 dark:text-green-500' : 'text-yellow-600 dark:text-yellow-500' }}">
                                        {{ $user->email_verified_at ? 'Verificado' : 'Pendente' }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Último login</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Nunca' }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Total de limpezas</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $user->assignedCleanings->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Details & Activity -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Stats Cards -->
                        @if($user->isCleaner())
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Cleanings Stats -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Limpezas Atribuídas</div>
                                        <div class="p-2 bg-mint/10 dark:bg-mint/20 rounded-lg">
                                            <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->assignedCleanings->count() }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Tarefas no total</div>
                                </div>

                                <!-- Pending Assignments -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Pendentes Resposta</div>
                                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-500">{{ $user->pendingCleaningAssignments->count() }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Aguardando confirmação</div>
                                </div>

                                <!-- Accepted Assignments -->
                                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Limpezas Aceites</div>
                                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-bold text-green-600 dark:text-green-500">{{ $user->acceptedCleaningAssignments->count() }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Confirmadas</div>
                                </div>
                            </div>
                        @endif

                        <!-- Recent Activity -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atividade Recente</h3>
                            </div>
                            <div class="p-6">
                                @if($user->assignedCleaningSchedules->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($user->assignedCleaningSchedules->take(5) as $schedule)
                                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 dark:hover:bg-gray-900/50 rounded-lg transition-colors">
                                                <div class="flex items-center gap-3">
                                                    <div class="p-2 bg-gray-100 dark:bg-gray-900 rounded-lg">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $schedule->accommodation->name }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $schedule->scheduled_date->format('d/m/Y') }} às {{ $schedule->scheduled_time->format('H:i') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    {{ $schedule->pivot->response_status === 'accepted' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' :
                                                       ($schedule->pivot->response_status === 'rejected' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' :
                                                       'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300') }}">
                                                    {{ $schedule->pivot->response_status === 'accepted' ? 'Aceite' :
                                                       ($schedule->pivot->response_status === 'rejected' ? 'Rejeitada' : 'Pendente') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($user->assignedCleaningSchedules->count() > 5)
                                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 text-center">
                                            <a href="#" class="text-sm text-mint hover:text-lagoon transition-colors">
                                                Ver todas as {{ $user->assignedCleaningSchedules->count() }} atividades
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-8">
                                        <div class="w-16 h-16 mx-auto bg-gray-100 dark:bg-gray-900 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400">Nenhuma atividade recente</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- System Information -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informações do Sistema</h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Account Information -->
                                    <div class="space-y-4">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Informações da Conta</h4>
                                        <div class="space-y-3">
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">ID do Utilizador</div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white font-mono">{{ $user->id }}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Email Primário</div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->email }}</div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Email Verificado</div>
                                                <div class="text-sm font-medium {{ $user->email_verified_at ? 'text-green-600 dark:text-green-500' : 'text-yellow-600 dark:text-yellow-500' }}">
                                                    {{ $user->email_verified_at ? 'Sim' : 'Não' }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Lembrar Token</div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $user->remember_token ? 'Definido' : 'Não definido' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Timestamps -->
                                    <div class="space-y-4">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Timestamps</h4>
                                        <div class="space-y-3">
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Criado em</div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $user->created_at->format('d/m/Y H:i:s') }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Atualizado em</div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $user->updated_at->format('d/m/Y H:i:s') }}
                                                </div>
                                            </div>
                                            @if($user->email_verified_at)
                                                <div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Email verificado em</div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $user->email_verified_at->format('d/m/Y H:i:s') }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if($user->last_login_at)
                                                <div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Último login</div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $user->last_login_at->format('d/m/Y H:i:s') }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Two-Factor Authentication -->
                                @if($user->two_factor_secret || $user->two_factor_recovery_codes)
                                    <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
                                        <h4 class="font-medium text-gray-900 dark:text-white mb-3">Autenticação de Dois Fatores</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium text-blue-800 dark:text-blue-300">
                                                    {{ $user->two_factor_secret ? 'Ativada' : 'Desativada' }}
                                                </span>
                                                </div>
                                                <div class="text-xs text-blue-700 dark:text-blue-400 mt-1">
                                                    {{ $user->two_factor_secret ? 'Segredo 2FA configurado' : 'Não configurado' }}
                                                </div>
                                            </div>

                                            @if($user->two_factor_recovery_codes)
                                                <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-100 dark:border-green-800">
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                        </svg>
                                                        <span class="text-sm font-medium text-green-800 dark:text-green-300">
                                                    Códigos de Recuperação
                                                </span>
                                                    </div>
                                                    <div class="text-xs text-green-700 dark:text-green-400 mt-1">
                                                        {{ count(json_decode(decrypt($user->two_factor_recovery_codes))) }} códigos disponíveis
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Danger Zone -->
                        @if($user->id !== auth()->id())
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-red-200 dark:border-red-800 overflow-hidden">
                                <div class="px-6 py-4 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/30">
                                    <h3 class="text-lg font-semibold text-red-800 dark:text-red-300">Zona de Perigo</h3>
                                    <p class="text-sm text-red-700 dark:text-red-400 mt-1">Ações irreversíveis - proceda com cautela</p>
                                </div>

                                <div class="p-6">
                                    <div class="space-y-4">
                                        <!-- Force Logout -->
                                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-white">Forçar Logout</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                    Remove todas as sessões ativas do utilizador em todos os dispositivos.
                                                </p>
                                            </div>

                                            <form action="{{ route('admin.users.force-logout', $user) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit"
                                                        onclick="return confirm('Tem certeza que deseja forçar o logout deste utilizador?')"
                                                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition-all duration-200 text-sm flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                    </svg>
                                                    Forçar Logout
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Delete User -->
                                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-white">Eliminar Utilizador Permanentemente</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                    Esta ação eliminará permanentemente o utilizador e todos os dados associados. Não pode ser desfeita.
                                                </p>
                                            </div>

                                            <form action="{{ route('admin.users.destroy', $user) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Tem certeza que deseja eliminar permanentemente este utilizador? TODOS os dados associados serão perdidos. Esta ação não pode ser desfeita.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Eliminar Permanentemente
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Additional Features -->
    <script>
        // Copy user ID to clipboard
        function copyUserId() {
            const userId = '{{ $user->id }}';
            navigator.clipboard.writeText(userId).then(() => {
                alert('ID do utilizador copiado para a área de transferência: ' + userId);
            });
        }

        // Toggle advanced details
        function toggleAdvancedDetails() {
            const details = document.getElementById('advanced-details');
            const button = document.getElementById('toggle-details-btn');

            if (details.classList.contains('hidden')) {
                details.classList.remove('hidden');
                button.innerHTML = 'Ocultar Detalhes Avançados';
            } else {
                details.classList.add('hidden');
                button.innerHTML = 'Mostrar Detalhes Avançados';
            }
        }

        // Format timestamps to local time
        document.addEventListener('DOMContentLoaded', function() {
            const timestamps = document.querySelectorAll('[data-timestamp]');
            timestamps.forEach(element => {
                const timestamp = element.getAttribute('data-timestamp');
                if (timestamp) {
                    const date = new Date(timestamp);
                    element.textContent = date.toLocaleString('pt-PT');
                }
            });
        });
    </script>
</x-app-layout>
