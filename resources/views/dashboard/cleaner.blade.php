<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-xl">
                            <svg class="w-7 h-7 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Minhas Tarefas</h1>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Olá, {{ Auth::user()->first_name }}</p>
                        </div>
                    </div>

                    <!-- Status Indicator -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-mint/5 dark:bg-mint/10 rounded-lg border border-mint/20 dark:border-mint/30">
                        <div class="w-2 h-2 bg-mint rounded-full"></div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            {{ now()->format('d/m/Y H:i') }}
                        </span>
                    </div>
                </div>

                <!-- Task List -->
                <div class="space-y-6">
                    @forelse($cleanings as $cleaning)
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300 overflow-hidden
                            {{ $cleaning->status == 'completed' ? 'opacity-80' : '' }}">

                            <!-- Status Border -->
                            <div class="border-l-4 h-full
                                {{ $cleaning->status == 'completed' ? 'border-mint' :
                                   ($cleaning->status == 'in_progress' ? 'border-yellow-500' : 'border-pine') }}">

                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-3
                                                {{ $cleaning->status == 'scheduled' ? 'bg-pine/10 dark:bg-pine/20 text-pine dark:text-mint' :
                                                   ($cleaning->status == 'in_progress' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300' :
                                                    'bg-mint/10 dark:bg-mint/20 text-mint dark:text-mint') }}">
                                                {{ match($cleaning->status) {
                                                    'scheduled' => 'Agendado',
                                                    'in_progress' => 'Em Andamento',
                                                    'completed' => 'Concluído',
                                                    default => $cleaning->status
                                                } }}
                                            </span>

                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $cleaning->accommodation->name }}</h3>
                                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mt-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span>{{ $cleaning->accommodation->address }}</span>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-pine dark:text-mint">
                                                {{ \Carbon\Carbon::parse($cleaning->scheduled_time)->format('H:i') }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($cleaning->scheduled_date)->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    @if($cleaning->notes)
                                        <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-100 dark:border-gray-700">
                                            <div class="flex items-start gap-2">
                                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                                </svg>
                                                <p class="text-sm text-gray-700 dark:text-gray-300 italic">"{{ $cleaning->notes }}"</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Action Buttons -->
                                    <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-700">
                                        @if($cleaning->status == 'scheduled')
                                            <form action="{{ route('cleaner.update_status', $cleaning->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="start">
                                                <button type="submit" class="w-full bg-pine hover:bg-lagoon text-white font-semibold py-3 px-4 rounded-lg shadow-sm hover:shadow transition-all duration-200 flex justify-center items-center gap-2 group">
                                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Iniciar Limpeza
                                                </button>
                                            </form>
                                        @endif

                                        @if($cleaning->status == 'in_progress')
                                            <form action="{{ route('cleaner.update_status', $cleaning->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="complete">

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                        Duração (minutos)
                                                    </label>
                                                    <input type="number"
                                                           name="duration"
                                                           placeholder="Opcional"
                                                           min="1"
                                                           max="480"
                                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                                </div>

                                                <button type="submit" class="w-full bg-mint hover:bg-lagoon text-white font-semibold py-3 px-4 rounded-lg shadow-sm hover:shadow transition-all duration-200 flex justify-center items-center gap-2 group">
                                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Concluir Tarefa
                                                </button>
                                            </form>
                                        @endif

                                        @if($cleaning->status == 'completed')
                                            <div class="flex items-center justify-center gap-2 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                                <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Tarefa Finalizada</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="w-20 h-20 mx-auto bg-mint/10 dark:bg-mint/20 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Tudo limpo! 🎉</h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                                Não tem tarefas pendentes de momento. Aproveite para descansar ou verificar novamente mais tarde.
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Stats Footer -->
                @if($cleanings->count() > 0)
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="text-2xl font-bold text-pine dark:text-mint">{{ $cleanings->where('status', 'scheduled')->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Agendadas</div>
                            </div>
                            <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-500">{{ $cleanings->where('status', 'in_progress')->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Em Andamento</div>
                            </div>
                            <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="text-2xl font-bold text-mint">{{ $cleanings->where('status', 'completed')->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Concluídas</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
