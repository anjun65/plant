<div>
        <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
          <div class="mx-auto max-w-4xl text-center">
            <h1 class="text-base font-semibold leading-7 text-indigo-600 dark:text-white">Pemantauan Tanaman</h1>
            <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Informasi Tanaman</p>
          </div>
          <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600 dark:text-white">Ringkasan data tanaman untuk mendukung pengambilan keputusan yang lebih tepat.</p>

        
          <div class="my-4 flex flex-col gap-3 sm:flex-row sm:items-center">
                <flux:date-picker mode="range" wire:model="range"/>
                    
                <div class="sm:ml-auto">
                    <flux:button wire:click="apply">
                        Terapkan
                    </flux:button>
                </div>
            </div>


          <div class="mt-4">
                <flux:chart wire:model="data" class="aspect-3/1">
                    <flux:chart.svg>

                        {{-- Soil Moisture --}}
                        <flux:chart.line
                            field="soil_moisture"
                            class="text-blue-500 dark:text-blue-400"
                        />

                        {{-- Temperature --}}
                        <flux:chart.line
                            field="temperature"
                            class="text-red-500 dark:text-red-400"
                        />

                        {{-- Light --}}
                        <flux:chart.line
                            field="light"
                            class="text-yellow-500 dark:text-yellow-400"
                        />

                        {{-- X Axis --}}
                        <flux:chart.axis axis="x" field="date">
                            <flux:chart.axis.line />
                            <flux:chart.axis.tick />
                        </flux:chart.axis>
                    
                        {{-- Y Axis --}}
                        <flux:chart.axis axis="y">
                            <flux:chart.axis.grid />
                            <flux:chart.axis.tick />
                        </flux:chart.axis>
                    
                        <flux:chart.cursor />
                    </flux:chart.svg>
                
                    <flux:chart.tooltip>
                        <flux:chart.tooltip.heading field="date" />
                        <flux:chart.tooltip.value field="soil_moisture" label="Soil Moisture (%)" />
                        <flux:chart.tooltip.value field="temperature" label="Temperature (°C)" />
                        <flux:chart.tooltip.value field="light" label="Light (Lux)" />
                    </flux:chart.tooltip>
                </flux:chart>
          </div>
        </div>

    </div>