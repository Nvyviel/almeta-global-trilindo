<!-- Modal container -->
<div x-data="{ open: false }" @show-payment-modal.window="open = true" @hide-payment-modal.window="open = false">

    <!-- Modal Backdrop -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 z-40"
        x-cloak>
    </div>

    <!-- Payment Modal -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-50 overflow-y-auto"
        x-cloak>
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <!-- Modal Header -->
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">
                            Payment Processing
                        </h3>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="mt-4 text-center">
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-indigo-600 mx-auto"></div>
                    <p class="mt-4 text-sm text-gray-500">
                        Please wait while we process your payment...
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('showPaymentModal', (snapToken) => {
            // Show modal using Alpine.js
            window.dispatchEvent(new CustomEvent('show-payment-modal'));
            
            // Initialize Midtrans Snap
            snap.pay(snapToken[0], {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    window.dispatchEvent(new CustomEvent('hide-payment-modal'));
                    Livewire.dispatch('paymentSuccess');
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    window.dispatchEvent(new CustomEvent('hide-payment-modal'));
                    Livewire.dispatch('paymentSuccess');
                },
                onError: function(result) {
                    console.log('Payment error:', result);
                    window.dispatchEvent(new CustomEvent('hide-payment-modal'));
                    Livewire.dispatch('paymentFailed');
                },
                onClose: function() {
                    console.log('Payment closed');
                    window.dispatchEvent(new CustomEvent('hide-payment-modal'));
                    Livewire.dispatch('paymentFailed');
                }
            });
        });

        // Success notification
        Livewire.on('paymentSuccess', () => {
            window.dispatchEvent(new CustomEvent('hide-payment-modal'));
            showNotification('Success!', 'Payment has been processed successfully', 'success');
        });

        // Failed notification
        Livewire.on('paymentFailed', () => {
            window.dispatchEvent(new CustomEvent('hide-payment-modal'));
            showNotification('Failed!', 'Payment process failed or was cancelled', 'error');
        });

        // Error notification
        Livewire.on('purchaseError', (message) => {
            window.dispatchEvent(new CustomEvent('hide-payment-modal'));
            showNotification('Error!', message, 'error');
        });
    });

    // Custom notification function using Tailwind
    function showNotification(title, message, type) {
        const notificationContainer = document.createElement('div');
        notificationContainer.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
            type === 'success' ? 'bg-green-50 text-green-800 border border-green-200' :
            'bg-red-50 text-red-800 border border-red-200'
        }`;
        
        notificationContainer.innerHTML = `
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    ${type === 'success' 
                        ? '<svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
                        : '<svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>'
                    }
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium">${title}</h3>
                    <div class="mt-1 text-sm">${message}</div>
                </div>
            </div>
        `;

        document.body.appendChild(notificationContainer);

        // Remove notification after 3 seconds
        setTimeout(() => {
            notificationContainer.remove();
        }, 3000);
    }
</script>
@endpush