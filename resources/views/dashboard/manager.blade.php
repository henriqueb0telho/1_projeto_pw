<x-app-layout>
    <div class="min-h-screen bg-[#dce1de] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-[#1f2421]">Painel de Gestão</h1>
                    <p class="text-[#216869]">Gestão Operacional da Empresa</p>
                </div>
                <div class="flex gap-3">
                    <a href="#" class="bg-white text-[#1f2421] px-4 py-2 rounded-lg font-medium shadow hover:bg-gray-50 transition">
                        👥 Gerir Equipa
                    </a>
{{--                    <a href="{{ route('admin.cleanings.create') }}" class="bg-[#49a078] text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-[#3d8b66] transition flex items-center gap-2">--}}
                    <a href="#" class="bg-[#49a078] text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-[#3d8b66] transition flex items-center gap-2">
                        ➕ Nova Limpeza
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-[#216869]">
                    <div class="text-sm text-gray-500 font-medium uppercase">Limpezas Hoje</div>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-[#1f2421]">{{ $stats['cleanings_today'] }}</span>
                        <span class="text-sm text-gray-400">agendadas</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-[#49a078]">
                    <div class="text-sm text-gray-500 font-medium uppercase">Equipa Ativa</div>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-[#1f2421]">{{ $stats['total_cleaners'] }}</span>
                        <span class="text-sm text-gray-400">cleaners</span>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-red-500">
                    <div class="text-sm text-gray-500 font-medium uppercase">Atenção Necessária</div>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-red-600">{{ $stats['pending_issues'] }}</span>
                        <span class="text-sm text-gray-400">atrasos</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-xl font-bold text-[#1f2421] flex items-center gap-2">
                        📅 Agenda de Hoje
                        <span class="text-xs font-normal bg-[#216869] text-white px-2 py-1 rounded-full">{{ \Carbon\Carbon::today()->format('d/m') }}</span>
                    </h2>

                    @if($todaysCleanings->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                            @foreach($todaysCleanings as $cleaning)
                                <div class="p-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-3 h-3 rounded-full
                                            {{ $cleaning->status === 'completed' ? 'bg-[#49a078]' :
                                               ($cleaning->status === 'in_progress' ? 'bg-yellow-400 animate-pulse' : 'bg-gray-300') }}">
                                        </div>

                                        <div>
                                            <h3 class="font-bold text-[#1f2421]">{{ $cleaning->accommodation->name }}</h3>
                                            <div class="text-sm text-gray-500 flex gap-3">
                                                <span>🕒 {{ \Carbon\Carbon::parse($cleaning->scheduled_time)->format('H:i') }}</span>
                                                <span>👤 {{ $cleaning->users->pluck('first_name')->join(', ') ?: 'Sem staff' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            {{ $cleaning->status === 'completed' ? 'bg-green-100 text-green-800' :
                                               ($cleaning->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600') }}">
                                            {{ match($cleaning->status) {
                                                'scheduled' => 'Pendente',
                                                'in_progress' => 'A decorrer',
                                                'completed' => 'Concluído',
                                                default => $cleaning->status
                                            } }}
                                        </span>
                                        <div class="mt-1">
{{--                                            <a href="{{ route('admin.cleanings.edit', $cleaning->id) }}" class="text-xs text-[#216869] hover:underline">Editar</a>--}}
                                            <a href="#" class="text-xs text-[#216869] hover:underline">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-xl p-8 text-center text-gray-500">
                            Não há limpezas agendadas para hoje.
                        </div>
                    @endif
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-bold text-[#1f2421] mb-4 border-b pb-2">Próximos Dias</h3>
                        <div class="space-y-4">
                            @foreach($upcomingCleanings as $next)
                                <div class="flex justify-between items-center text-sm">
                                    <div>
                                        <div class="font-medium text-[#1f2421]">{{ $next->accommodation->name }}</div>
                                        <div class="text-gray-500">{{ \Carbon\Carbon::parse($next->scheduled_date)->format('d/m') }} às {{ \Carbon\Carbon::parse($next->scheduled_time)->format('H:i') }}</div>
                                    </div>
                                    <div class="w-2 h-2 rounded-full bg-[#9cc5a1]"></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pt-2 border-t text-center">
{{--                            <a href="{{ route('admin.cleanings.index') }}" class="text-sm text-[#216869] font-medium hover:text-[#1f2421]">Ver Calendário Completo →</a>--}}
                            <a href="#" class="text-sm text-[#216869] font-medium hover:text-[#1f2421]">Ver Calendário Completo →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
