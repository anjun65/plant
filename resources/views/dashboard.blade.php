<x-layouts.app :title="__('Dashboard')">
    <div>
        <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
          <div class="mx-auto max-w-4xl text-center">
            <h1 class="text-base font-semibold leading-7 text-indigo-600 dark:text-white">Pemantauan Tanaman</h1>
            <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Informasi Tanaman</p>
          </div>
          <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600 dark:text-white">Ringkasan data tanaman untuk mendukung pengambilan keputusan yang lebih tepat.</p>

        
          <div class="mt-4">
            <flux:chart wire:model="data" class="aspect-3/1">
                <flux:chart.svg>
                    <flux:chart.line field="visitors" class="text-pink-500 dark:text-pink-400" />

                    <flux:chart.axis axis="x" field="date">
                        <flux:chart.axis.line />
                        <flux:chart.axis.tick />
                    </flux:chart.axis>
                
                    <flux:chart.axis axis="y">
                        <flux:chart.axis.grid />
                        <flux:chart.axis.tick />
                    </flux:chart.axis>
                
                    <flux:chart.cursor />
                </flux:chart.svg>
            
                <flux:chart.tooltip>
                    <flux:chart.tooltip.heading field="date" :format="['year' => 'numeric', 'month' => 'numeric', 'day' => 'numeric']" />
                    <flux:chart.tooltip.value field="visitors" label="Visitors" />
                </flux:chart.tooltip>
            </flux:chart>
            </div>
        </div>

    </div>

</x-layouts.app>
