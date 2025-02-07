@extends('layouts.fullscreen')
@section('component')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden">
        {{-- Header Section --}}
        <div class="bg-gradient-to-r from-blue-100 to-blue-200 px-6 py-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-3 md:mb-0 tracking-tight">Detail Pengguna</h1>
            <a href="{{ route('dashboard-admin') }}" wire:navigate
               class="btn btn-primary bg-blue-600 text-white hover:bg-blue-700 transition-all px-5 py-2 rounded-lg shadow-md flex items-center">
                <i class="fas fa-arrow-left mr-3"></i>Kembali ke Daftar
            </a>
        </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
        {{-- Account Information --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Informasi Akun</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500">Email</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->email }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500">Nama</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500">Status Admin</span>
                            <div class="flex items-center">
                                <span class="badge {{ $user->is_admin ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }} rounded-full px-3 py-1">
                                    {{ $user->is_admin ? 'Administrator' : 'User' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Company Information --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Informasi Perusahaan</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500">Nama Perusahaan</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->company_name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500">Nomor Telepon</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $user->company_phone_number }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500">Alamat</span>
                            <span class="text-sm font-semibold text-gray-900 text-right w-1/2">{{ $user->company_address }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        @if(auth()->user()->id == 1 && $user->id != 1)
            <form id="adminStatusForm" action="{{ route('isadmin', $user->id) }}" method="POST">
                @csrf
                <button type="button" onclick="confirmAdminStatusChange()" class="btn {{ $user->is_admin ? 'btn-warning' : 'btn-success' }} bg-gray-100 text-gray-800 rounded-full mb-3 px-3 py-1 text-sm">
                    {{ $user->is_admin ? 'Make to User' : 'Make to Administrator' }}
                </button>
            </form>
        @endif

        <script>
        function confirmAdminStatusChange() {
            const form = document.getElementById('adminStatusForm');
            const isAdmin = {{ $user->is_admin ? 'true' : 'false' }};
            const userName = "{{ $user->name }}";
            
            Swal.fire({
                title: isAdmin ? 'Downgrade to User?' : 'Upgrade to Administrator?',
                html: `Are you sure you want to change the status of <strong>${userName}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: isAdmin ? '#d33' : '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: isAdmin ? 'Yes, Make to User' : 'Yes, Make to Administrator'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
        </script>
    </div>
    
    {{-- Documents Section --}}
    <div class="bg-gray-50 p-8 border-t border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Dokumen</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['ktp' => 'KTP', 'npwp' => 'NPWP', 'nib' => 'NIB'] as $doc => $label)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="p-4 bg-gray-100 border-b">
                        <h3 class="text-sm font-semibold text-gray-700 text-center uppercase tracking-wider">{{ $label }}</h3>
                    </div>
                    <div class="p-4">
                        <button onclick="openModal('{{ asset('storage/' . $user->$doc) }}', '{{ $label }}')" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            View Image
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>
{{-- Modal untuk Gambar --}}
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-80 flex items-center justify-center">
    <div class="relative max-w-full max-h-full">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-4xl">&times;</button>
        <img id="modalImage" src="" alt="Document" class="max-w-full max-h-screen object-contain">
        <p id="modalTitle" class="text-white text-center mt-4 text-xl"></p>
    </div>
</div>
<script>
function openModal(src, title) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    
    modalImage.src = src;
    modalTitle.textContent = title;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// Tutup modal jika mengklik di luar gambar
document.getElementById('imageModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});
</script>
@endsection