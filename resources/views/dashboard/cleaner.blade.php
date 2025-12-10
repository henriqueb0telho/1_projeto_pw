<x-app-layout>
    <div class="min-h-screen bg-[#dce1de] py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-[#1f2421]">Minhas Tarefas</h1>
                <p class="text-[#216869] text-sm">Olá, {{ Auth::user()->first_name }}</p>
            </div>

            <div class="space-y-4">
                @forelse($cleanings as $cleaning)

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border-l-8
                        {{ $cleaning->status == 'completed' ? 'border-[#9cc5a1] opacity-75' :
                           ($cleaning->status == 'in_progress' ? 'border-yellow-500' : 'border-[#216869]') }}">

                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="inline-block px-2 py-1 text-xs font-bold rounded mb-2
                                        {{ $cleaning->status == 'scheduled' ? 'bg-[#dce1de] text-[#1f2421]' :
                                           ($cleaning->status == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-[#9cc5a1] text-[#1f2421]') }}">
                                        {{ match($cleaning->status) {
                                            'scheduled' => 'Agendado',
                                            'in_progress' => 'Em Andamento',
                                            'completed' => 'Concluído',
                                            default => $cleaning->status
                                        } }}
                                    </span>

                                    <h3 class="text-xl font-bold text-[#1f2421]">{{ $cleaning->accommodation->name }}</h3>
                                    <p class="text-gray-500 text-sm mt-1 flex items-center">
                                        📍 {{ $cleaning->accommodation->address }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <div class="text-2xl font-bold text-[#216869]">
                                        {{ \Carbon\Carbon::parse($cleaning->scheduled_time)->format('H:i') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($cleaning->scheduled_date)->format('d/m') }}
                                    </div>
                                </div>
                            </div>

                            @if($cleaning->notes)
                                <div class="mt-4 p-3 bg-[#dce1de] bg-opacity-30 rounded text-sm text-[#1f2421] italic border border-[#dce1de]">
                                    📝 "{{ $cleaning->notes }}"
                                </div>
                            @endif

                            <div class="mt-6 pt-4 border-t border-gray-100">

                                @if($cleaning->status == 'scheduled')
                                    <form action="{{ route('cleaner.update_status', $cleaning->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="start">
                                        <button type="submit" class="w-full bg-[#216869] hover:bg-[#1f2421] text-white font-bold py-3 px-4 rounded-lg shadow transition duration-200 flex justify-center items-center gap-2">
                                            ▶️ Iniciar Limpeza
                                        </button>
                                    </form>
                                @endif

                                @if($cleaning->status == 'in_progress')
                                    <form action="{{ route('cleaner.update_status', $cleaning->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="complete">

                                        <div class="mb-3">
                                            <input type="number" name="duration" placeholder="Duração em minutos (opcional)" class="w-full text-sm border-gray-300 rounded-lg focus:border-[#49a078] focus:ring-[#49a078]">
                                        </div>

                                        <button type="submit" class="w-full bg-[#49a078] hover:bg-[#3d8b66] text-white font-bold py-3 px-4 rounded-lg shadow transition duration-200 flex justify-center items-center gap-2">
                                            ✅ Concluir Tarefa
                                        </button>
                                    </form>
                                @endif

                                @if($cleaning->status == 'completed')
                                    <div class="w-full bg-gray-100 text-gray-400 font-semibold py-2 px-4 rounded-lg text-center cursor-default">
                                        Tarefa Finalizada
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                @empty
                    <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                        <div class="text-4xl mb-3">🎉</div>
                        <h3 class="text-lg font-medium text-[#1f2421]">Tudo limpo!</h3>
                        <p class="text-gray-500">Não tem tarefas pendentes de momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
