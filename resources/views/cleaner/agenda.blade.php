<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-mint/10 dark:bg-mint/20 rounded-xl">
                            <svg class="w-7 h-7 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Painel do Cleaner</h1>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Olá, {{ Auth::user()->first_name }}</p>
                        </div>
                    </div>
                </div>

                @if($pendingAssignments->count() > 0)
                    <div class="mb-10">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <span class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></span>
                            Novos Pedidos de Limpeza
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($pendingAssignments as $assignment)
                                <div class="bg-white dark:bg-gray-800 rounded-xl border-l-4 border-yellow-500 shadow-sm p-6" x-data="{ showReschedule: false }">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $assignment->cleaningSchedule->accommodation->name }}</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $assignment->cleaningSchedule->accommodation->address }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-pine dark:text-mint">
                                                {{ $assignment->cleaningSchedule->scheduled_date->format('d/m/Y') }}
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $assignment->cleaningSchedule->scheduled_time->format('H:i') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="!showReschedule" class="flex gap-3 mt-6">
                                        <form action="{{ route('cleaner.respond', $assignment) }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="response" value="accepted">
                                            <button type="submit" class="w-full py-2 px-4 bg-green-100 hover:bg-green-200 text-green-800 rounded-lg font-bold transition-colors">
                                                Aceitar
                                            </button>
                                        </form>

                                        <button @click="showReschedule = true" type="button" class="flex-1 py-2 px-4 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded-lg font-bold transition-colors">
                                            Pedir Alteração
                                        </button>

                                        <form action="{{ route('cleaner.respond', $assignment) }}" method="POST" class="flex-1" onsubmit="return confirm('Tem a certeza que quer rejeitar esta tarefa?')">
                                            @csrf
                                            <input type="hidden" name="response" value="rejected">
                                            <button type="submit" class="w-full py-2 px-4 bg-red-100 hover:bg-red-200 text-red-800 rounded-lg font-bold transition-colors">
                                                Rejeitar
                                            </button>
                                        </form>
                                    </div>

                                    <div x-show="showReschedule" class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700" x-transition>
                                        <h4 class="font-bold text-gray-900 dark:text-white mb-3">Sugerir Nova Data</h4>
                                        <form action="{{ route('cleaner.reschedule', $assignment) }}" method="POST">
                                            @csrf
                                            <div class="space-y-3">
                                                <div class="grid grid-cols-2 gap-3">
                                                    <div>
                                                        <label class="text-xs text-gray-500">Nova Data</label>
                                                        <input type="date" name="requested_date" required min="{{ date('Y-m-d') }}"
                                                               class="w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-600 text-sm">
                                                    </div>
                                                    <div>
                                                        <label class="text-xs text-gray-500">Nova Hora</label>
                                                        <input type="time" name="requested_time" required
                                                               class="w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-600 text-sm">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-500">Motivo</label>
                                                    <textarea name="reason" rows="2" required placeholder="Explique o motivo..."
                                                              class="w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-600 text-sm"></textarea>
                                                </div>
                                                <div class="flex gap-2 pt-2">
                                                    <button type="button" @click="showReschedule = false" class="flex-1 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg text-sm font-medium">Cancelar</button>
                                                    <button type="submit" class="flex-1 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium">Enviar Pedido</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($reschedulePending->count() > 0)
                    <div class="mb-10">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 opacity-75">Pedidos de Alteração Pendentes</h2>
                        <div class="space-y-4">
                            @foreach($reschedulePending as $assignment)
                                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-200 dark:border-gray-700 p-4 flex justify-between items-center opacity-75">
                                    <div class="flex items-center gap-4">
                                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/20 rounded-full">
                                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 dark:text-white">{{ $assignment->cleaningSchedule->accommodation->name }}</h4>
                                            <p class="text-xs text-gray-500">Aguardando resposta do gerente para mudança de data.</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">Pendente</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Minha Agenda</h2>

                    <div class="space-y-6">
                        @forelse($activeAssignments as $assignment)
                            @php
                                $cleaning = $assignment->cleaningSchedule;
                                // Obter histórico de reschedules para mostrar feedback
                                $reschedules = $assignment->rescheduleRequests()->orderBy('created_at', 'desc')->get();
                                $lastReschedule = $reschedules->first();
                            @endphp

                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md dark:hover:shadow-xl transition-all duration-300 overflow-hidden
                                {{ $cleaning->status == 'completed' ? 'opacity-70' : '' }}" x-data="{ showHistory: false }">

                                <div class="border-l-4 h-full
                                    {{ $cleaning->status == 'completed' ? 'border-mint' :
                                       ($cleaning->status == 'in_progress' ? 'border-yellow-500' : 'border-pine') }}">

                                    <div class="p-6">
                                        @if($lastReschedule && $lastReschedule->status != 'pending')
                                            <div class="mb-4 p-3 rounded-lg text-sm border
                                                {{ $lastReschedule->status == 'approved' ? 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300' : 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300' }}">
                                                <div class="flex justify-between items-start">
                                                    <span class="font-bold">
                                                        {{ $lastReschedule->status == 'approved' ? 'Pedido de alteração aceite' : 'Pedido de alteração rejeitado' }}
                                                    </span>
                                                    <span class="text-xs opacity-75">{{ $lastReschedule->updated_at->diffForHumans() }}</span>
                                                </div>
                                                @if($lastReschedule->manager_response_note)
                                                    <div class="mt-1">
                                                        <span class="font-semibold text-xs uppercase opacity-75">Nota do Gerente:</span>
                                                        <p class="italic">"{{ $lastReschedule->manager_response_note }}"</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

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
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    <span>{{ $cleaning->accommodation->address }}</span>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <div class="text-2xl font-bold text-pine dark:text-mint">
                                                    {{ $cleaning->scheduled_time->format('H:i') }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $cleaning->scheduled_date->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </div>

                                        @if($cleaning->notes)
                                            <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-100 dark:border-gray-700">
                                                <div class="flex items-start gap-2">
                                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 italic">"{{ $cleaning->notes }}"</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($reschedules->count() > 0)
                                            <div class="mt-4">
                                                <button @click="showHistory = !showHistory" class="text-xs text-pine dark:text-mint hover:underline flex items-center gap-1">
                                                    <span x-text="showHistory ? 'Ocultar Histórico de Alterações' : 'Ver Histórico de Alterações'"></span>
                                                    <svg class="w-3 h-3" :class="{'rotate-180': showHistory}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </button>

                                                <div x-show="showHistory" class="mt-2 space-y-2" x-transition>
                                                    @foreach($reschedules as $req)
                                                        <div class="text-xs p-2 bg-gray-50 dark:bg-gray-900/50 rounded border border-gray-100 dark:border-gray-700">
                                                            <div class="flex justify-between font-semibold">
                                                                <span>Pedido: {{ \Carbon\Carbon::parse($req->requested_date)->format('d/m') }} às {{ \Carbon\Carbon::parse($req->requested_time)->format('H:i') }}</span>
                                                                <span class="{{ $req->status == 'approved' ? 'text-green-600' : ($req->status == 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                                                                    {{ match($req->status) { 'approved' => 'Aprovado', 'rejected' => 'Rejeitado', default => 'Pendente' } }}
                                                                </span>
                                                            </div>
                                                            <div class="mt-1 text-gray-500">Motivo: {{ $req->reason }}</div>
                                                            @if($req->manager_response_note)
                                                                <div class="mt-1 pl-2 border-l-2 border-gray-300 text-gray-600 dark:text-gray-400">
                                                                    Resposta: {{ $req->manager_response_note }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-700">
                                            @if($cleaning->status == 'scheduled')
                                                <form action="{{ route('cleaner.update_status', $assignment->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="start">
                                                    <button type="submit" class="w-full bg-pine hover:bg-lagoon text-white font-semibold py-3 px-4 rounded-lg shadow-sm hover:shadow transition-all duration-200 flex justify-center items-center gap-2 group">
                                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        Iniciar Limpeza
                                                    </button>
                                                </form>
                                            @endif

                                            @if($cleaning->status == 'in_progress')
                                                <form action="{{ route('cleaner.update_status', $assignment->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="complete">
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duração (minutos)</label>
                                                        <input type="number" name="duration" placeholder="Ex: 120" min="1" max="480" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-mint focus:border-mint bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-150">
                                                    </div>
                                                    <button type="submit" class="w-full bg-mint hover:bg-lagoon text-white font-semibold py-3 px-4 rounded-lg shadow-sm hover:shadow transition-all duration-200 flex justify-center items-center gap-2 group">
                                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        Concluir Tarefa
                                                    </button>
                                                </form>
                                            @endif

                                            @if($cleaning->status == 'completed')
                                                <div class="flex items-center justify-center gap-2 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                                    <svg class="w-5 h-5 text-mint" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Tarefa Finalizada ({{ $cleaning->actual_duration ?? '?' }} min)</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                                <div class="w-20 h-20 mx-auto bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Agenda Vazia</h3>
                                <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">Não tem limpezas aceites de momento.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
