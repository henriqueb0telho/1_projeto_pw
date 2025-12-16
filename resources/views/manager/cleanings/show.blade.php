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

                @foreach($schedule->cleaningAssignments as $assignment)
                    @if($reschedule = $assignment->getPendingReschedule())
                        <div x-data="{ showRejectModal: false, showAcceptModal: false }" class="mb-8 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500 p-4 rounded-r-xl shadow-sm">
                            <div class="flex items-start justify-between">
                                <div class="flex gap-4">
                                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/40 rounded-full">
                                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 dark:text-white">Pedido de Alteração de Horário</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                            O cleaner <strong>{{ $assignment->user->first_name }}</strong> solicitou uma mudança.
                                        </p>
                                        <div class="mt-3 grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <span class="block text-xs text-gray-500 uppercase">Data Proposta</span>
                                                <span class="font-mono font-bold text-gray-900 dark:text-white">
                                                    {{ \Carbon\Carbon::parse($reschedule->requested_date)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="block text-xs text-gray-500 uppercase">Hora Proposta</span>
                                                <span class="font-mono font-bold text-gray-900 dark:text-white">
                                                    {{ \Carbon\Carbon::parse($reschedule->requested_time)->format('H:i') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-sm bg-white dark:bg-gray-800 p-2 rounded border border-yellow-100 dark:border-yellow-900/30">
                                            <span class="text-xs text-gray-500 uppercase">Motivo:</span>
                                            <p class="italic text-gray-700 dark:text-gray-300">"{{ $reschedule->reason }}"</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <button @click="showAcceptModal = true" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-lg shadow-sm transition-colors">
                                        Aceitar
                                    </button>
                                    <button @click="showRejectModal = true" class="px-4 py-2 bg-white dark:bg-gray-800 border border-red-200 dark:border-red-800 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-sm font-medium rounded-lg transition-colors">
                                        Rejeitar
                                    </button>
                                </div>
                            </div>

                            <div x-show="showAcceptModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true"><div class="absolute inset-0 bg-gray-500 opacity-75"></div></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <form action="{{ route('manager.cleanings.handle-reschedule', $reschedule) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Confirmar Alteração</h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        Data passará para <strong>{{ \Carbon\Carbon::parse($reschedule->requested_date)->format('d/m/Y') }}</strong> às <strong>{{ \Carbon\Carbon::parse($reschedule->requested_time)->format('H:i') }}</strong>.
                                                    </p>
                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nota de resposta (opcional)</label>
                                                        <textarea name="manager_response" rows="2" class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm">Confirmar</button>
                                                <button @click="showAcceptModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div x-show="showRejectModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true"><div class="absolute inset-0 bg-gray-500 opacity-75"></div></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <form action="{{ route('manager.cleanings.handle-reschedule', $reschedule) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Rejeitar Pedido</h3>
                                                <div class="mt-4">
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Motivo da rejeição *</label>
                                                    <textarea name="manager_response" rows="3" required class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm"></textarea>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Rejeitar</button>
                                                <button @click="showRejectModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

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
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4">Histórico de Alterações</h3>
                            <div class="space-y-4 max-h-60 overflow-y-auto">
                                @php
                                    // Coletar todos os reschedules de todos os assignments desta limpeza
                                    $allReschedules = collect();
                                    foreach($schedule->cleaningAssignments as $assign) {
                                        foreach($assign->rescheduleRequests as $req) {
                                            $req->cleaner_name = $assign->user->first_name;
                                            $allReschedules->push($req);
                                        }
                                    }
                                    $allReschedules = $allReschedules->sortByDesc('created_at');
                                @endphp

                                @forelse($allReschedules as $req)
                                    <div class="text-sm border-l-2 pl-3 {{ $req->status == 'approved' ? 'border-green-500' : ($req->status == 'rejected' ? 'border-red-500' : 'border-yellow-500') }}">
                                        <div class="flex justify-between">
                                            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $req->cleaner_name }}</span>
                                            <span class="text-xs text-gray-500">{{ $req->created_at->format('d/m') }}</span>
                                        </div>
                                        <div class="text-xs mt-1">
                                            Pedido: {{ \Carbon\Carbon::parse($req->requested_date)->format('d/m') }} às {{ \Carbon\Carbon::parse($req->requested_time)->format('H:i') }}
                                        </div>
                                        <div class="text-xs text-gray-500 italic">"{{ $req->reason }}"</div>

                                        <div class="mt-1 font-bold text-xs
                                            {{ $req->status == 'approved' ? 'text-green-600' : ($req->status == 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                                            {{ match($req->status) { 'approved' => 'Aceite', 'rejected' => 'Rejeitado', default => 'Pendente' } }}
                                        </div>
                                        @if($req->manager_response_note)
                                            <div class="text-xs text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700 mt-1 pt-1">
                                                Resp: "{{ $req->manager_response_note }}"
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 italic">Sem registo de pedidos de alteração.</p>
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
