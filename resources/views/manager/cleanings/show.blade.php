<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('manager.cleanings.index') }}"
                               class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detalhes da Limpeza</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">ID: #{{ $schedule->id }}</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('manager.cleanings.edit', $schedule) }}"
                               class="px-4 py-2 bg-white border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Editar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                            <div class="p-6 bg-gradient-to-r from-pine/10 to-mint/10 dark:from-pine/20 dark:to-mint/20 flex justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <div class="h-16 w-16 bg-white dark:bg-gray-800 rounded-xl flex items-center justify-center shadow-sm">
                                        <svg class="w-8 h-8 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $schedule->accommodation->name }}</h2>
                                        <div class="flex items-center gap-2 mt-1">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $schedule->accommodation->address }}</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ match($schedule->status) {
                                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                        'in_progress' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                    } }}">
                                    {{ match($schedule->status) {
                                        'scheduled' => 'Agendada',
                                        'in_progress' => 'A decorrer',
                                        'completed' => 'Concluída',
                                        'cancelled' => 'Cancelada',
                                        default => $schedule->status
                                    } }}
                                </span>
                            </div>

                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Data e Hora</label>
                                    <div class="mt-2 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-lg font-medium text-gray-900 dark:text-white">{{ $schedule->scheduled_date->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="mt-1 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-lg font-medium text-gray-900 dark:text-white">{{ $schedule->scheduled_time->format('H:i') }}</span>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Estimativa</label>
                                    <div class="mt-2 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-lg font-medium text-gray-900 dark:text-white">{{ $schedule->accommodation->cleaning_time_estimate }} horas</span>
                                    </div>
                                    @if($schedule->actual_duration)
                                        <div class="mt-1 flex items-center gap-2">
                                            <span class="text-sm text-gray-500">Duração Real: {{ $schedule->actual_duration }} min</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($schedule->notes)
                                <div class="px-6 pb-6 pt-0">
                                    <label class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Notas e Instruções</label>
                                    <div class="mt-2 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-700 text-gray-700 dark:text-gray-300 text-sm whitespace-pre-line">
                                        {{ $schedule->notes }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4">Equipa Atribuída</h3>

                            <div class="space-y-4">
                                @forelse($schedule->users as $cleaner)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-600">
                                                {{ substr($cleaner->first_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-white text-sm">{{ $cleaner->first_name }} {{ $cleaner->last_name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $cleaner->pivot->role_in_cleaning === 'primary' ? 'Líder' : 'Assistente' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div title="{{ ucfirst($cleaner->pivot->response_status) }}">
                                            @if($cleaner->pivot->response_status === 'accepted')
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @elseif($cleaner->pivot->response_status === 'rejected')
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            @else
                                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 italic">Nenhum staff atribuído.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                            <div class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                                <div class="flex justify-between">
                                    <span>Criado em:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $schedule->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Última atualização:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $schedule->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
