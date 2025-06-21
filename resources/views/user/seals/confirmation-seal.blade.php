@extends('layouts.main')

@section('title', 'Confirmation')
@section('component')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-shield-alt text-blue-600 mr-3"></i>
                Seal Confirmation
            </h1>
            <p class="text-gray-600">Complete your seal verification process</p>
        </div>

        <!-- Main Card -->
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold mb-1">Seal Information</h2>
                            <p class="text-blue-100">ID: {{ $seal->id_seal }}</p>
                        </div>
                        <div class="text-right">
                            <div class="bg-white bg-opacity-20 rounded-lg p-3">
                                <i class="fas fa-check-circle text-3xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Seal Details - Column 1 -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <div class="w-6 h-6 bg-blue-600 rounded-lg flex items-center justify-center mr-2">
                                    <i class="fas fa-info-circle text-white text-xs"></i>
                                </div>
                                Seal Details
                            </h3>

                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border">
                                    <span class="font-medium text-gray-700 text-sm">Seal ID:</span>
                                    <span class="text-gray-900 font-bold">{{ $seal->id_seal ?? 'N/A' }}</span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border">
                                    <span class="font-medium text-gray-700 text-sm">Status:</span>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        @if (($seal->status ?? '') === 'Payment Proccess') bg-amber-100 text-amber-800 border border-amber-300
                                        @elseif(($seal->status ?? '') === 'Confirmed') bg-green-100 text-green-800 border border-green-300
                                        @else bg-gray-100 text-gray-800 border border-gray-300 @endif">
                                        {{ $seal->status ?? 'Unknown' }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border">
                                    <span class="font-medium text-gray-700 text-sm">Type:</span>
                                    <span class="text-gray-900 font-medium">{{ $seal->type ?? 'Standard' }}</span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border">
                                    <span class="font-medium text-gray-700 text-sm">Priority:</span>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">Normal</span>
                                </div>
                            </div>
                        </div>

                        <!-- Process Status - Column 2 -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <div class="w-6 h-6 bg-green-600 rounded-lg flex items-center justify-center mr-2">
                                    <i class="fas fa-tasks text-white text-xs"></i>
                                </div>
                                Process Status
                            </h3>

                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200">
                                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Seal Created</p>
                                        <p class="text-green-700 text-xs">Successfully created</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200">
                                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-credit-card text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Payment Processed</p>
                                        <p class="text-green-700 text-xs">Payment completed</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Awaiting Confirmation</p>
                                        <p class="text-blue-700 text-xs">Please confirm to complete</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information Form - Column 3 -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <div class="w-6 h-6 bg-purple-600 rounded-lg flex items-center justify-center mr-2">
                                    <i class="fas fa-credit-card text-white text-xs"></i>
                                </div>
                                Payment Information
                            </h3>

                            <form id="paymentForm" action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="space-y-4">
                                    <!-- Tanggal Pembayaran -->
                                    <div>
                                        <label for="payment_date" class="block text-xs font-semibold text-gray-700 mb-1">
                                            <i class="fas fa-calendar-alt mr-1 text-blue-600"></i>Payment Date *
                                        </label>
                                        <input type="date" id="payment_date" name="payment_date"
                                            value="{{ old('payment_date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('payment_date') border-red-500 @enderror"
                                            required>
                                        @error('payment_date')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Jenis Bank -->
                                    <div>
                                        <label for="bank_type" class="block text-xs font-semibold text-gray-700 mb-1">
                                            <i class="fas fa-university mr-1 text-blue-600"></i>Bank Type *
                                        </label>
                                        <select id="bank_type" name="bank_type"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('bank_type') border-red-500 @enderror"
                                            required>
                                            <option value="">Select Bank</option>
                                            <option value="BCA" {{ old('bank_type') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                            <option value="BNI" {{ old('bank_type') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                            <option value="BRI" {{ old('bank_type') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                            <option value="Mandiri" {{ old('bank_type') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                            <option value="CIMB Niaga" {{ old('bank_type') == 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                                            <option value="Other" {{ old('bank_type') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('bank_type')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nomor Rekening -->
                                    <div>
                                        <label for="bank_number" class="block text-xs font-semibold text-gray-700 mb-1">
                                            <i class="fas fa-hashtag mr-1 text-blue-600"></i>Account Number *
                                        </label>
                                        <input type="text" id="bank_number" name="bank_number"
                                            value="{{ old('bank_number') }}" placeholder="Enter account number"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('bank_number') border-red-500 @enderror"
                                            pattern="[0-9]{10,20}" title="10-20 digits required" required>
                                        @error('bank_number')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Upload Bukti Transfer -->
                                    <div>
                                        <label for="transfer_proof" class="block text-xs font-semibold text-gray-700 mb-1">
                                            <i class="fas fa-upload mr-1 text-blue-600"></i>Transfer Proof *
                                        </label>
                                        <input type="file" id="transfer_proof" name="transfer_proof" accept="image/*,.pdf"
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('transfer_proof') border-red-500 @enderror"
                                            onchange="previewFile(this)" required>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, PDF (Max: 5MB)</p>
                                        @error('transfer_proof')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                        
                                        <!-- File Preview -->
                                        <div id="filePreview" class="mt-2 hidden">
                                            <div class="flex items-center p-2 bg-gray-50 rounded border">
                                                <i class="fas fa-file-alt text-gray-500 mr-2 text-sm"></i>
                                                <div>
                                                    <p id="fileName" class="text-xs font-medium text-gray-900"></p>
                                                    <p id="fileSize" class="text-xs text-gray-500"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Notes -->
                                    <div>
                                        <label for="notes" class="block text-xs font-semibold text-gray-700 mb-1">
                                            <i class="fas fa-sticky-note mr-1 text-blue-600"></i>Notes (Optional)
                                        </label>
                                        <textarea id="notes" name="notes" rows="2" placeholder="Additional information..."
                                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <!-- Submit Payment Info Button -->
                            <button onclick="submitPaymentForm()" id="submitBtn"
                                class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-8 py-3 rounded-lg font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center min-w-[200px]">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Submit Payment Info
                            </button>

                            <!-- Back Link -->
                            <a href="{{ route('seal') }}"
                                class="inline-flex items-center text-gray-600 hover:text-gray-800 font-semibold transition-colors duration-200 px-6 py-2 rounded-lg hover:bg-gray-100">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Seal List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Info -->
        <div class="max-w-6xl mx-auto mt-4">
            <div class="flex items-center justify-center text-gray-600 text-sm">
                <i class="fas fa-info-circle text-gray-400 mr-2"></i>
                <span>Need help? Contact support at
                    <a href="mailto:support@company.com" class="text-blue-600 hover:text-blue-800 font-medium">support@company.com</a>
                </span>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .btn-loading {
            pointer-events: none;
            opacity: 0.7;
        }

        /* Compact scrollbar for textarea */
        textarea::-webkit-scrollbar {
            width: 4px;
        }

        textarea::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Custom file input styling */
        input[type="file"]::file-selector-button {
            margin-right: 8px;
            padding: 4px 12px;
            border-radius: 4px;
            border: none;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        input[type="file"]::file-selector-button:hover {
            background: #dbeafe;
        }

        /* Ensure consistent height across columns */
        .grid > div {
            display: flex;
            flex-direction: column;
        }

        /* Animation for form validation */
        .border-red-500 {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-2px); }
            75% { transform: translateX(2px); }
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .grid-cols-1.lg\\:grid-cols-3 {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
    </style>

    <!-- JavaScript -->
    <script>
        function submitPaymentForm() {
            const form = document.getElementById('paymentForm');
            const btn = document.getElementById('submitBtn');
            const originalContent = btn.innerHTML;

            // Validate form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            if (confirm('Are you sure you want to submit this payment information?')) {
                // Show loading state
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
                btn.classList.add('btn-loading');

                // Submit form (uncomment the line below when you have the actual route)
                // form.submit();
                
                // Simulate submission for now
                setTimeout(() => {
                    alert('Payment information submitted successfully!');
                    btn.innerHTML = '<i class="fas fa-check mr-2"></i>Submitted!';
                    btn.classList.remove('from-green-600', 'to-green-700', 'hover:from-green-700', 'hover:to-green-800');
                    btn.classList.add('from-gray-500', 'to-gray-600');
                    btn.disabled = true;
                }, 2000);
            }
        }

        function previewFile(input) {
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileSizeInMB = (file.size / 1024 / 1024).toFixed(2);

                fileName.textContent = file.name;
                fileSize.textContent = `${fileSizeInMB} MB`;
                filePreview.classList.remove('hidden');

                // Validate file size (5MB limit)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    input.value = '';
                    filePreview.classList.add('hidden');
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a valid file type (JPG, PNG, or PDF)');
                    input.value = '';
                    filePreview.classList.add('hidden');
                    return;
                }
            } else {
                filePreview.classList.add('hidden');
            }
        }

        // Enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation styling
            const formInputs = document.querySelectorAll('input, select, textarea');
            formInputs.forEach(input => {
                input.addEventListener('invalid', function() {
                    this.classList.add('border-red-500');
                    setTimeout(() => {
                        this.classList.remove('border-red-500');
                    }, 500);
                });

                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('border-red-500');
                        this.classList.add('border-green-500');
                    } else {
                        this.classList.remove('border-green-500');
                    }
                });

                // Remove green border on blur if empty
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.classList.remove('border-green-500');
                    }
                });
            });

            // Auto-resize textarea
            const textarea = document.getElementById('notes');
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 80) + 'px';
            });

            // Button hover effects
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.addEventListener('mouseenter', function() {
                if (!this.classList.contains('btn-loading')) {
                    this.style.transform = 'scale(1.02)';
                }
            });

            submitBtn.addEventListener('mouseleave', function() {
                if (!this.classList.contains('btn-loading')) {
                    this.style.transform = 'scale(1)';
                }
            });
        });
    </script>
@endsection