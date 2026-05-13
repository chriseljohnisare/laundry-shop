<x-admin-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pending Approvals</h2>
            <p class="text-gray-500 font-medium">Review and authorize new system registrations.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-5">User Details</th>
                        <th class="px-8 py-5">Email Address</th>
                        <th class="px-8 py-5">Role Type</th>
                        <th class="px-8 py-5">Registration Date</th>
                        <th class="px-8 py-5 text-right">Approval Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($users as $user)
                        <tr class="hover:bg-amber-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center font-black text-sm shadow-inner transition-all duration-300">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-black text-gray-900 tracking-tight">{{ $user->name }}</p>
                                        <p class="text-[10px] font-bold text-amber-500 uppercase tracking-widest">Awaiting Review</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-gray-700">{{ $user->email }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-600">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-gray-400">{{ $user->created_at->format('d M Y, H:i') }}</span>
                            </td>
                            <td class="px-8 py-6 text-right space-x-2">
                                <div class="inline-flex rounded-xl bg-gray-50 p-1 border border-gray-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="h-9 px-4 flex items-center justify-center rounded-lg bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest hover:bg-indigo-700 transition-all">
                                            <i class="fas fa-check mr-2"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-9 w-9 flex items-center justify-center rounded-lg text-gray-400 hover:bg-white hover:text-red-500 hover:shadow-sm transition-all" onclick="return confirm('Reject and delete this registration?')">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-20 w-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-user-check text-2xl text-gray-200"></i>
                                    </div>
                                    <h5 class="text-lg font-black text-gray-400 italic">No pending registrations.</h5>
                                    <p class="text-gray-300 text-sm mt-2">All new accounts have been processed.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 bg-gray-50/50 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
