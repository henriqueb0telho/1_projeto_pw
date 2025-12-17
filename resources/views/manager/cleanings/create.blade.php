<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-2">
                        <a href="{{ route('dashboard') }}" class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Agendar Nova Limpeza</h1>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Defina o local, data e equipa responsável</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

                            <div class="h-1 w-full bg-gray-100 dark:bg-gray-700">
                                <div class="h-1 bg-mint w-1/3"></div>
                            </div>

                            <form action="{{ route('manager.cleanings.store') }}" method="POST" class="p-6 space-y-8">
                                @csrf

                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-8 h-8 rounded-full bg-mint/20 text-mint flex items-center justify-center font-bold text-sm">1</div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Onde e Quando?</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pl-11">
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alojamento *</label>
                                            <select name="accommodation_id" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">
                                                <option value="">Selecione o alojamento...</option>
                                                @foreach($accommodations as $acc)
                                                    <option value="{{ $acc->id }}" {{ old('accommodation_id') == $acc->id ? 'selected' : '' }}>
                                                        {{ $acc->name }} ({{ $acc->cleaning_time_estimate }}h est.)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('accommodation_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Data *</label>
                                            <input type="date" name="scheduled_date" value="{{ old('scheduled_date') }}" min="{{ date('Y-m-d') }}" required
                                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">
                                            @error('scheduled_date') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hora de Início *</label>
                                            <input type="time" name="scheduled_time" value="{{ old('scheduled_time', '10:00') }}" required
                                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">
                                            @error('scheduled_time') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 dark:border-gray-700"></div>

                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-8 h-8 rounded-full bg-lagoon/20 text-lagoon flex items-center justify-center font-bold text-sm">2</div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atribuição de Equipa</h3>
                                    </div>

                                    <div class="pl-11 space-y-5">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Líder de Equipa (Responsável)
                                            </label>
                                            <div class="relative">
                                                <select name="primary_cleaner_id" class="w-full pl-10 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-lagoon focus:ring focus:ring-lagoon/20 transition-shadow">
                                                    <option value="">-- Sem atribuição (Pendente) --</option>
                                                    @foreach($cleaners as $cleaner)
                                                        <option value="{{ $cleaner->id }}" {{ old('primary_cleaner_id') == $cleaner->id ? 'selected' : '' }}>
                                                            {{ $cleaner->first_name }} {{ $cleaner->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">Este funcionário receberá a notificação principal.</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                                Assistentes (Opcional)
                                            </label>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-48 overflow-y-auto p-1">
                                                @foreach($cleaners as $cleaner)
                                                    <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                                        <input type="checkbox" name="assistants[]" value="{{ $cleaner->id }}" class="w-4 h-4 text-lagoon border-gray-300 rounded focus:ring-lagoon">
                                                        <span class="ml-3 text-sm text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">
                                                            {{ $cleaner->first_name }} {{ $cleaner->last_name }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 dark:border-gray-700"></div>

                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 flex items-center justify-center font-bold text-sm">3</div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Instruções</h3>
                                    </div>

                                    <div class="pl-11">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notas para a Equipa</label>
                                        <textarea name="notes" rows="3" placeholder="Ex: Atenção especial à limpeza da varanda..."
                                                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">{{ old('notes') }}</textarea>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-white border border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        Cancelar
                                    </a>
                                    <button type="submit" class="px-5 py-2.5 bg-mint hover:bg-lagoon text-white font-bold rounded-lg shadow-sm hover:shadow transition-all flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Agendar Limpeza
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">

                        <div class="bg-pine/5 dark:bg-pine/20 rounded-xl border border-pine/10 dark:border-pine/30 p-6">
                            <h3 class="font-bold text-pine dark:text-mint mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Dica de Gestão
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Certifique-se de atribuir um <strong>Líder de Equipa</strong> para garantir que alguém é responsável por reportar o início e fim da tarefa na app.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-bold text-gray-900 dark:text-white">Ocupação Recente</h3>
                                <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-1 rounded">Próx. 5 dias</span>
                            </div>

                            @if($upcomingSchedules->count() > 0)
                                <div class="space-y-4">
                                    @foreach($upcomingSchedules as $schedule)
                                        <div class="flex gap-3 text-sm">
                                            <div class="flex flex-col items-center min-w-[3rem]">
                                                <span class="font-bold text-gray-900 dark:text-white">{{ $schedule->scheduled_date->format('d') }}</span>
                                                <span class="text-xs text-gray-500 uppercase">{{ $schedule->scheduled_date->format('M') }}</span>
                                            </div>
                                            <div class="flex-1 pb-4 border-b border-gray-100 dark:border-gray-700 last:border-0 last:pb-0">
                                                <p class="font-medium text-gray-900 dark:text-white truncate">{{ $schedule->accommodation->name }}</p>
                                                <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                                    <span class="bg-gray-100 dark:bg-gray-700 px-1.5 rounded">{{ $schedule->scheduled_time->format('H:i') }}</span>
                                                    <span>
                                                        {{ $schedule->cleaningAssignments->count() }} staff
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic text-center py-4">Sem agendamentos próximos.</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
