@extends('layouts.admin')

@section('title', 'Manajemen Users - DompetKu')

@section('content')
<!-- Header -->
<div class="mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-neutral-text mb-2">Manajemen Users 👥</h1>
    <p class="text-neutral-text-secondary text-sm md:text-base">Kelola username dan monitor aktivitas user</p>
</div>

<!-- Search -->
<div class="card mb-6">
    <form method="GET" action="{{ route('admin.users') }}" class="flex flex-col sm:flex-row gap-2">
        <input type="text" name="search" placeholder="Cari nama atau email..." 
               value="{{ $search ?? '' }}"
               class="flex-1 px-4 py-2 border border-neutral-bg-tertiary rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors whitespace-nowrap">
            Cari
        </button>
    </form>
</div>

<!-- Users List -->
<div class="card">
    @if($users->count() > 0)
        <!-- Desktop Table View (Hidden on mobile) -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-neutral-bg-tertiary">
                        <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary">No</th>
                        <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary">Nama</th>
                        <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary hidden md:table-cell">Email</th>
                        <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary">Status</th>
                        <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr class="border-b border-neutral-bg-tertiary hover:bg-neutral-bg-secondary transition-colors">
                            <td class="py-3 px-3 md:px-4 text-sm text-neutral-text-secondary">{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                            <td class="py-3 px-3 md:px-4 text-sm text-neutral-text font-medium">{{ $user->name }}</td>
                            <td class="py-3 px-3 md:px-4 text-sm text-neutral-text-secondary hidden md:table-cell">{{ $user->email }}</td>
                            <td class="py-3 px-3 md:px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->isOnline() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    <span class="inline-block w-2 h-2 rounded-full mr-1 {{ $user->isOnline() ? 'bg-green-500' : 'bg-gray-500' }}"></span>
                                    {{ $user->isOnline() ? 'Online' : 'Offline' }}
                                </span>
                            </td>
                            <td class="py-3 px-3 md:px-4">
                                <button type="button" 
                                        onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}')"
                                        class="text-primary text-sm font-medium hover:underline">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Shown on mobile only) -->
        <div class="sm:hidden space-y-3">
            @foreach($users as $user)
                <div class="bg-neutral-bg-secondary rounded-lg p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h4 class="font-semibold text-neutral-text">{{ $user->name }}</h4>
                            <p class="text-sm text-neutral-text-secondary">{{ $user->email }}</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium flex-shrink-0 {{ $user->isOnline() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            <span class="inline-block w-2 h-2 rounded-full mr-1 {{ $user->isOnline() ? 'bg-green-500' : 'bg-gray-500' }}"></span>
                            {{ $user->isOnline() ? 'Online' : 'Offline' }}
                        </span>
                    </div>
                    <button type="button" 
                            onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}')"
                            class="w-full px-3 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors">
                        Edit Username
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 overflow-x-auto">
            {{ $users->links() }}
        </div>
    @else
        <div class="py-12 text-center">
            <svg class="w-12 h-12 text-neutral-text-secondary mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-neutral-text-secondary text-sm">Tidak ada data user</p>
        </div>
    @endif
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full mx-auto">
        <h3 class="text-lg font-bold text-neutral-text mb-4">Edit Username</h3>
        
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium text-neutral-text mb-2">Username Baru</label>
                <input type="text" id="newName" name="name" required
                       class="w-full px-3 py-2 border border-neutral-bg-tertiary rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeEditModal()"
                        class="flex-1 px-4 py-2 border border-neutral-bg-tertiary text-neutral-text rounded-lg text-sm font-medium hover:bg-neutral-bg-secondary transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(userId, currentName) {
    document.getElementById('newName').value = currentName;
    document.getElementById('editForm').action = `/admin/users/${userId}`;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEditModal();
    }
});
</script>
@endsection

