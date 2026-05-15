<x-admin-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Staff & Users</h2>
            <p class="text-gray-500 font-medium">Manage administrative access and system users.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-5">User & Role</th>
                        <th class="px-8 py-5">Email Address</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5">Joined Date</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($users as $user)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-gradient-to-tr {{ $user->role === 'admin' ? 'from-indigo-600 to-indigo-400' : 'from-slate-100 to-slate-200' }} rounded-2xl flex items-center justify-center {{ $user->role === 'admin' ? 'text-white' : 'text-slate-500' }} font-black text-sm shadow-inner transition-all duration-300">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-black text-gray-900 tracking-tight">{{ $user->name }}</p>
                                        <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest">{{ $user->role }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-gray-700">{{ $user->email }}</p>
                            </td>
                            <td class="px-8 py-6">
                                @if($user->is_approved)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-600">
                                        <i class="fas fa-check-circle mr-1.5"></i>
                                        Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 text-amber-600">
                                        <i class="fas fa-clock mr-1.5"></i>
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-gray-400">{{ $user->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-9 w-9 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all" onclick="return confirm('Delete this user account?')">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-24 text-center">
                                <p class="text-gray-400 font-bold italic">No users found.</p>
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
