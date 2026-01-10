<div>

  <div class="relative w-full">
      <div class="flex">
          <div class="flex-1">
              <flux:heading size="xl" level="1">{{ __('Perangkat') }}</flux:heading>
              <flux:subheading size="lg" class="mb-6">{{ __('List Seluruh Perangkat') }}</flux:subheading>
          </div>
          <flux:modal.trigger name="create-device">
                <flux:button>Tambah Perangkat</flux:button>
          </flux:modal.trigger>
      </div>
  </div>

  <livewire:user.device-create/>
  <livewire:user.device-edit/>

  <flux:modal name="delete-device" class="min-w-[22rem]">
      <div class="space-y-6">
          <div>
              <flux:heading size="lg">Hapus Perangkat?</flux:heading>

              <flux:subheading>
                  <p>Anda akan menghapus data ini.</p>
                  <p>Data yang dihapus tidak bisa dikembalikan.</p>
              </flux:subheading>
              
          </div>

          <div class="flex gap-2">
              <flux:spacer/>

              <flux:modal.close>
                  <flux:button variant="ghost">Batal</flux:button>
              </flux:modal.close>

              <flux:button type="submit" wire:click="destroy()" variant="danger">
                  Hapus Perangkat
              </flux:button>
          </div>
      </div>
  </flux:modal>


  <section x-data="{ openFilters: false }" aria-labelledby="filter-heading" class="grid items-center border-b border-t border-gray-200">
    
    <div class="relative col-start-1 row-start-1 py-4">
        <div class="mx-auto flex space-x-4 divide-x divide-gray-200">
          <div>
            <flux:button type="button" x-on:click="openFilters = ! openFilters" class="group flex mr-4 items-center font-medium text-gray-700 dark:text-white" aria-controls="disclosure-1" aria-expanded="false">
              <svg class="mr-2 h-5 w-5 flex-none text-gray-400 group-hover:text-gray-500" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
              </svg>
              Filters
            </flux:button>
          </div>
          <div>
            <flux:button type="button" wire:click="clearFilters" class="text-gray-500 dark:text-white">
              Clear all</flux:button>
          </div>
        </div>
      </div>
    <div x-show="openFilters" class="border-t border-gray-200 py-10" id="disclosure-1">
      <div class="mx-auto grid grid-cols-1 gap-x-4 px-4 text-sm sm:px-6 md:gap-x-6 lg:px-8">
        <div class="grid auto-rows-min grid-cols-1 gap-y-4 md:grid-cols-2 md:gap-x-6">
          
          <div>
            <div class="space-y-6 sm:space-y-4">
              <flux:input label="Nama" wire:model="filterName" placeholder="Masukkan Nama ..." />
            </div>
          </div>
          
          
          <div>
            <div class="space-y-6 sm:space-y-4">
              <flux:input label="Email" wire:model="filterEmail" placeholder="Masukkan Email ..." />
            </div>
          </div>

          <div>
            <div class="space-y-6 sm:space-y-4">
              <flux:select wire:model="filterRole" label="Role" placeholder="Pilih Role...">
                  <flux:select.option value="user">User</flux:select.option>
                  <flux:select.option value="admin">Admin</flux:select.option>
              </flux:select>
            </div>
          </div>
          <div></div>
          <div></div>
          <div class="text-right">
            <flux:button wire:click="filter" variant="primary">Apply</flux:button>
          </div>
        </div>
      </div>
    </div>
    
  </section>

  
  
  <flux:table :paginate="$this->deviceList" class="shadow ring-1 ring-gray-50">
      <flux:table.columns class="bg-gray-50 dark:bg-neutral-600">
          <flux:table.column sortable :sorted="$sortBy === 'device_id'" :direction="$sortDirection" wire:click="sort('device_id')">
              <div class="pl-4">Device ID</div>
          </flux:table.column>
          <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection" wire:click="sort('name')">Name</flux:table.column>
          <flux:table.column sortable :sorted="$sortBy === 'latitude'" :direction="$sortDirection" wire:click="sort('latitude')">Latitude</flux:table.column>
          <flux:table.column sortable :sorted="$sortBy === 'longitude'" :direction="$sortDirection" wire:click="sort('longitude')">Longitude</flux:table.column>
          <flux:table.column sortable :sorted="$sortBy === 'is_active'" :direction="$sortDirection" wire:click="sort('is_active')">Aktif</flux:table.column>
          
          <flux:table.column></flux:table.column>
      </flux:table.columns>

      <flux:table.rows class="pl-4">
          @forelse ($this->deviceList as $device)
              <flux:table.row :key="$device->id">

                  <flux:table.cell>
                      <div class="pl-4 flex items-center gap-3">
                          <flux:icon.device-tablet variant="micro" />

                          {{ $device->device_id }}
                      </div>
                  </flux:table.cell>
                  <flux:table.cell class="whitespace-nowrap">{{ $device->name }}</flux:table.cell>
                  <flux:table.cell class="whitespace-nowrap">{{ $device->latitude }}</flux:table.cell>
                  <flux:table.cell class="whitespace-nowrap">{{ $device->longitude }}</flux:table.cell>
                  <flux:table.cell class="whitespace-nowrap">{{ $device->is_active }}</flux:table.cell>

                  <flux:table.cell>
                      <flux:dropdown>
                          <flux:button variant="ghost">
                              <flux:icon icon="ellipsis-horizontal"></flux:icon>
                          </flux:button>
                                      
                          <flux:menu>
                              <flux:menu.item icon="pencil-square" wire:click="edit({{$device->id}})">Edit</flux:menu.item>
                              <flux:menu.item icon="trash" variant="danger" wire:click="delete({{$device->id}})">Delete</flux:menu.item>
                          </flux:menu>
                      </flux:dropdown>
                  </flux:table.cell>
              </flux:table.row>
            @empty
            <flux:table.row>
                <flux:table.cell rowspan="4" class="whitespace-nowrap w-full text-center">Data Tidak ditemukan....</flux:table.cell>
            </flux:table.row>
            @endforelse
      </flux:table.rows>
  </flux:table>

  
</div>
