<div>
    <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
      <div class="mx-auto max-w-4xl text-center">
        <h1 class="text-base font-semibold leading-7 text-indigo-600 dark:text-white">Cek Penyakit Tanaman</h1>
        <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Kenali Penyakit Tanaman Lebih Awal</p>
      </div>
      <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600 dark:text-white">Deteksi dini membantu tanaman tetap sehat dan hasil panen lebih optimal.</p>
      
        <div class="mt-4">
            <flux:file-upload wire:model="photos" multiple label="Upload files">
                <flux:file-upload.dropzone
                    heading="Drop files here or click to browse"
                    text="JPG, PNG, GIF up to 10MB"
                />
            </flux:file-upload>

            <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                    heading="Profile_pic.jpg"
                    image="https://fluxui.dev/img/demo/user.png"
                    size="162400"
                >
                    <x-slot name="actions">
                        <flux:file-item.remove />
                    </x-slot>
                </flux:file-item>
            </div>
        </div>
    </div>

</div>
