<div>
    <flux:modal name="edit-user" class="md:w-96 w-100">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit User</flux:heading>
                <flux:subheading>Masukkan detail user.</flux:subheading>
            </div>
            
            

            <flux:select wire:model="role" placeholder="Pilih Role..." label="Role">
                <flux:select.option value="user">User</flux:select.option>
                <flux:select.option value="admin">Admin</flux:select.option>
            </flux:select>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Simpan</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
