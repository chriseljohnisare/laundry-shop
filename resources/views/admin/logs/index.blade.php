<x-admin-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Activity Logs</h2>
            <p class="text-gray-500 font-medium">System-wide audit trail for administrative actions.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Timestamp</th>
                        <th class="px-8 py-5">Actor</th>
                        <th class="px-8 py-5">Action</th>
                        <th class="px-8 py-5">Description</th>
                        <th class="px-8 py-5">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($logs as $log)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-5 whitespace-nowrap">
                                <span class="text-[11px] font-black text-slate-400 uppercase tracking-tighter">{{ $log->created_at->format('M d, Y') }}</span>
                                <p class="text-[10px] font-bold text-slate-300">{{ $log->created_at->format('H:i:s') }}</p>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-slate-100 rounded-lg flex items-center justify-center text-[10px] font-black text-slate-500 mr-3">
                                        {{ $log->user ? strtoupper(substr($log->user->name, 0, 2)) : 'SYS' }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-700">{{ $log->user ? $log->user->name : 'System' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $actionColors = [
                                        'created' => 'bg-emerald-100 text-emerald-600',
                                        'updated' => 'bg-indigo-100 text-indigo-600',
                                        'deleted' => 'bg-red-100 text-red-600',
                                        'approved' => 'bg-blue-100 text-blue-600',
                                    ];
                                    $color = $actionColors[$log->action] ?? 'bg-slate-100 text-slate-600';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $color }}">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <p class="text-sm text-slate-600 font-medium">{{ $log->description }}</p>
                            </td>
                            <td class="px-8 py-5">
                                @if($log->properties)
                                    <button x-data @click="$dispatch('open-modal', 'log-details-{{ $log->id }}')" class="text-[10px] font-black uppercase tracking-widest text-indigo-500 hover:text-indigo-700 transition-colors">
                                        View JSON
                                    </button>

                                    <x-modal name="log-details-{{ $log->id }}" :show="false">
                                        <div class="p-8">
                                            <h3 class="text-lg font-black text-slate-900 mb-4">Payload Details</h3>
                                            <pre class="bg-slate-900 text-emerald-400 p-6 rounded-2xl text-xs overflow-x-auto custom-scrollbar font-mono leading-relaxed">
{{ json_encode($log->properties, JSON_PRETTY_PRINT) }}
                                            </pre>
                                            <div class="mt-8 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">Close</x-secondary-button>
                                            </div>
                                        </div>
                                    </x-modal>
                                @else
                                    <span class="text-[10px] font-bold text-slate-300 italic uppercase">No data</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <p class="text-slate-400 font-bold italic">No activity recorded yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 bg-gray-50/50 border-t border-gray-100">
            {{ $logs->links() }}
        </div>
    </div>
</x-admin-layout>
