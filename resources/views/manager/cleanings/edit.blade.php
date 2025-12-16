<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-150">
        <div class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-2">
                        <a href="{{ route('manager.cleanings.show', $schedule) }}" class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Editar Agendamento</h1>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $schedule->accommodation->name }} - {{ $schedule->scheduled_date->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <form action="{{ route('manager.cleanings.update', $schedule) }}" method="POST" class="p-6 space-y-8">
                        @csrf
                        @method('PUT')

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Detalhes</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alojamento</label>
                                    <div class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-300 cursor-not-allowed">
                                        {{ $schedule->accommodation->name }}
                                    </div>
                                    <input type="hidden" name="accommodation_id" value="{{ $schedule->accommodation_id }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Data *</label>
                                    <input type="date" name="scheduled_date" value="{{ old('scheduled_date', $schedule->scheduled_date->format('Y-m-d')) }}" required
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hora de Início *</label>
                                    <input type="time" name="scheduled_time" value="{{ old('scheduled_time', $schedule->scheduled_time->format('H:i')) }}" required
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Estado</label>
                                    <select name="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">
                                        <option value="scheduled" {{ $schedule->status == 'scheduled' ? 'selected' : '' }}>Agendada (Pendente)</option>
                                        <option value="in_progress" {{ $schedule->status == 'in_progress' ? 'selected' : '' }}>Em Progresso</option>
                                        <option value="completed" {{ $schedule->status == 'completed' ? 'selected' : '' }}>Concluída</option>
                                        <option value="cancelled" {{ $schedule->status == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 dark:border-gray-700"></div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Equipa</h3>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Líder de Equipa</label>
                                    <select name="primary_cleaner_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-lagoon focus:ring focus:ring-lagoon/20 transition-shadow">
                                        <option value="">-- Sem atribuição --</option>
                                        @foreach($cleaners as $cleaner)
                                            <option value="{{ $cleaner->id }}"
                                                {{ old('primary_cleaner_id', $schedule->primaryCleaners->first()?->id) == $cleaner->id ? 'selected' : '' }}>
                                                {{ $cleaner->first_name }} {{ $cleaner->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Assistentes</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-48 overflow-y-auto p-1 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                                        @php
                                            $currentAssistants = $schedule->assistants->pluck('id')->toArray();
                                        @endphp
                                        @foreach($cleaners as $cleaner)
                                            <label class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                                                <input type="checkbox" name="assistants[]" value="{{ $cleaner->id }}"
                                                       {{ in_array($cleaner->id, old('assistants', $currentAssistants)) ? 'checked' : '' }}
                                                       class="w-4 h-4 text-lagoon border-gray-300 rounded focus:ring-lagoon">
                                                <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">
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
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notas</label>
                            <textarea name="notes" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:border-mint focus:ring focus:ring-mint/20 transition-shadow">{{ old('notes', $schedule->notes) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('manager.cleanings.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" class="px-5 py-2.5 bg-mint hover:bg-lagoon text-white font-bold rounded-lg shadow-sm hover:shadow transition-all flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-red-200 dark:border-red-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/30">
                        <h3 class="text-lg font-semibold text-red-800 dark:text-red-300">Apagar Agendamento</h3>
                        <p class="text-sm text-red-700 dark:text-red-400 mt-1">Esta ação é irreversível.</p>
                    </div>
                    <div class="p-6 flex items-center justify-between">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Deseja eliminar este agendamento permanentemente?</p>
                        <form action="{{ route('manager.cleanings.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Tem a certeza?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
