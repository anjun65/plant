<div>
        <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
          <div class="mx-auto max-w-4xl text-center">
            <h1 class="text-base font-semibold leading-7 text-indigo-600 dark:text-white">Pemantauan Tanaman</h1>
            <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Informasi Tanaman</p>
          </div>
          <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600 dark:text-white">Ringkasan data tanaman untuk mendukung pengambilan keputusan yang lebih tepat.</p>

        
          <div class="my-4 flex flex-col gap-3 sm:flex-row sm:items-center">
                <flux:select wire:model="device_id" placeholder="Pilih Device Anda...">
                    @forelse ($this->devices as $device)
                        <flux:select.option value="{{ $device->id }}">{{ $device->name }}</flux:select.option> 
                    @empty
                        <flux:select.option value="">Data Tidak ditemukan...</flux:select.option> 
                    @endforelse
                </flux:select>    
                
                <flux:date-picker mode="range" wire:model="range"/>

                <div class="sm:ml-auto">
                    

                    <flux:button wire:click="apply">
                        Terapkan
                    </flux:button>
                </div>
            </div>


          <div class="mt-4">
            <flux:card>
                <flux:chart class="grid gap-6" wire:model.live="data">
                    <flux:chart.summary class="flex gap-12">
                        <div>
                            <flux:text class="text-green-500">Soil Moisture</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-green-500 tabular-nums">
                                <flux:chart.summary.value field="soil_moisture" /> %
                            </flux:heading>
                        </div>
                    
                        <div>
                            <flux:text class="text-red-500">Temperature</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-red-500 tabular-nums">
                                <flux:chart.summary.value field="temperature"/> °C
                            </flux:heading>
                        </div>

                        <div>
                            <flux:text class="text-yellow-500">Humidity</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-yellow-500 tabular-nums">
                                <flux:chart.summary.value field="humidity"/> % RH
                            </flux:heading>
                        </div>

                        <div>
                            <flux:text class="text-blue-500">Light</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-blue-500  tabular-nums">
                                <flux:chart.summary.value field="light" /> lux
                            </flux:heading>
                        </div>

                        <div>
                            <flux:text>Date</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 tabular-nums">
                                <flux:chart.summary.value field="time_label" />
                            </flux:heading>
                        </div>

                        
                    </flux:chart.summary>
                
                    <flux:chart.viewport class="aspect-[3/1]">
                        <flux:chart.svg>
                            <flux:chart.line field="soil_moisture" class="text-green-500" />
                            <flux:chart.line field="temperature" class="text-red-500" />
                            <flux:chart.line field="humidity" class="text-yellow-500" />
                            <flux:chart.line field="light" class="text-blue-500" />
                
                            <flux:chart.axis axis="x" field="time_label">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                                <flux:chart.axis.line />
                            </flux:chart.axis>
                        
                            <flux:chart.axis axis="y">
                                <flux:chart.axis.tick />
                            </flux:chart.axis>
                        
                            <flux:chart.cursor />
                        </flux:chart.svg>
                    </flux:chart.viewport>
                </flux:chart>
            </flux:card>
          </div>

          <div class="mt-4">
            <flux:card>
                <flux:chart class="grid gap-6" wire:model.live="data">
                    <flux:chart.summary class="flex gap-12">
                        <div>
                            <flux:text class="text-green-500">Soil Moisture</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-green-500 tabular-nums">
                                <flux:chart.summary.value field="soil_moisture" /> %
                            </flux:heading>
                        </div>

                        <div>
                            <flux:text>Date</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 tabular-nums">
                                <flux:chart.summary.value field="time_label" />
                            </flux:heading>
                        </div>

                        
                    </flux:chart.summary>
                
                    <flux:chart.viewport class="aspect-[3/1]">
                        <flux:chart.svg>
                            <flux:chart.line field="soil_moisture" class="text-green-500" />
                
                            <flux:chart.axis axis="x" field="time_label">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                                <flux:chart.axis.line />
                            </flux:chart.axis>
                        
                            <flux:chart.axis axis="y">
                                <flux:chart.axis.tick />
                            </flux:chart.axis>
                        
                            <flux:chart.cursor />
                        </flux:chart.svg>
                    </flux:chart.viewport>
                </flux:chart>
            </flux:card>
          </div>

          <div class="mt-4">
            <flux:card>
                <flux:chart class="grid gap-6" wire:model.live="data">
                    <flux:chart.summary class="flex gap-12">
                        
                    
                        <div>
                            <flux:text class="text-red-500">Temperature</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-red-500 tabular-nums">
                                <flux:chart.summary.value field="temperature"/> °C
                            </flux:heading>
                        </div>

                        <div>
                            <flux:text>Date</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 tabular-nums">
                                <flux:chart.summary.value field="time_label" />
                            </flux:heading>
                        </div>

                        
                    </flux:chart.summary>
                
                    <flux:chart.viewport class="aspect-[3/1]">
                        <flux:chart.svg>
                            <flux:chart.line field="temperature" class="text-red-500" />
                
                            <flux:chart.axis axis="x" field="time_label">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                                <flux:chart.axis.line />
                            </flux:chart.axis>
                        
                            <flux:chart.axis axis="y">
                                <flux:chart.axis.tick />
                            </flux:chart.axis>
                        
                            <flux:chart.cursor />
                        </flux:chart.svg>
                    </flux:chart.viewport>
                </flux:chart>
            </flux:card>
          </div>

          <div class="mt-4">
            <flux:card>
                <flux:chart class="grid gap-6" wire:model.live="data">
                    <flux:chart.summary class="flex gap-12">

                        <div>
                            <flux:text class="text-yellow-500">Humidity</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-yellow-500 tabular-nums">
                                <flux:chart.summary.value field="humidity"/> % RH
                            </flux:heading>
                        </div>

                        <div>
                            <flux:text>Date</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 tabular-nums">
                                <flux:chart.summary.value field="time_label" />
                            </flux:heading>
                        </div>

                        
                    </flux:chart.summary>
                
                    <flux:chart.viewport class="aspect-[3/1]">
                        <flux:chart.svg>
                            <flux:chart.line field="humidity" class="text-yellow-500" />
                
                            <flux:chart.axis axis="x" field="time_label">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                                <flux:chart.axis.line />
                            </flux:chart.axis>
                        
                            <flux:chart.axis axis="y">
                                <flux:chart.axis.tick />
                            </flux:chart.axis>
                        
                            <flux:chart.cursor />
                        </flux:chart.svg>
                    </flux:chart.viewport>
                </flux:chart>
            </flux:card>
          </div>

          <div class="mt-4">
            <flux:card>
                <flux:chart class="grid gap-6" wire:model.live="data">
                    <flux:chart.summary class="flex gap-12">
                        <div>
                            <flux:text class="text-blue-500">Light</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 text-blue-500  tabular-nums">
                                <flux:chart.summary.value field="light" /> lux
                            </flux:heading>
                        </div>

                        <div>
                            <flux:text>Date</flux:text>
                        
                            <flux:heading size="lg" class="mt-2 tabular-nums">
                                <flux:chart.summary.value field="time_label" />
                            </flux:heading>
                        </div>

                        
                    </flux:chart.summary>
                
                    <flux:chart.viewport class="aspect-[3/1]">
                        <flux:chart.svg>
                            <flux:chart.line field="light" class="text-blue-500" />
                
                            <flux:chart.axis axis="x" field="time_label">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                                <flux:chart.axis.line />
                            </flux:chart.axis>
                        
                            <flux:chart.axis axis="y">
                                <flux:chart.axis.tick />
                            </flux:chart.axis>
                        
                            <flux:chart.cursor />
                        </flux:chart.svg>
                    </flux:chart.viewport>
                </flux:chart>
            </flux:card>
          </div>
        </div>

    </div>