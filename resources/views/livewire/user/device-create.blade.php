<div>
    <flux:modal name="create-device" class="md:w-96 w-100">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Perangkat</flux:heading>
                <flux:subheading>Masukkan detail perangkat.</flux:subheading>
            </div>

            <flux:input label="Device ID" wire:model="device_id" placeholder="Masukkan Nama" />
            <flux:input label="Nama" wire:model="name" placeholder="Masukkan Nama" />
            <flux:input label="Latitude" wire:model="latitude" placeholder="Masukkan Nama" />
            <flux:input label="Longitude" wire:model="longitude" placeholder="Masukkan Nama" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="submit">Simpan</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
