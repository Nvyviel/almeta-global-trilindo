<div>
    <form wire:submit.prevent="createBill">
        <div>
            <label for="shipment_id">Shipment</label>
            <select wire:model.live="shipment_id" id="shipment_id" required>
                <option value="">Select Shipment</option>
                @foreach($shipments as $shipment)
                    <option value="{{ $shipment->id }}">
                        Shipment-{{ $shipment->id }} (From: {{ $shipment->from_city }} To: {{ $shipment->to_city }})
                    </option>
                @endforeach
            </select>
        </div>

        @if($shipment_id)
            <div>
                <label for="container_id">Containers with Approved Shipping Instructions</label>
                <select wire:model.live="container_id" id="container_id" required>
                    <option value="">Select Container</option>
                    @foreach($containers as $container)
                        <option value="{{ $container->id }}">
                            {{ $container->container_number }} (Type: {{ $container->container_type }})
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if($container_id)
            <div>
                <label>User Details</label>
                <p>User: {{ \App\Models\User::find($user_id)->name }}</p>
            </div>
        @endif

        <div>
            <label for="status">Bill Status</label>
            <select wire:model="status" id="status" required>
                <option value="Unpaid">Unpaid</option>
                <option value="Paid">Paid</option>
            </select>
        </div>

        <button type="submit">Create Bill</button>
    </form>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>