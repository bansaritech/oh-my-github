<x-filament::widget>
    <x-filament::card>
        <div>
            <div class="flex mb-3">
                <input
                    wire:model="username"
                    placeholder="Insert Your Username Here..."
                    class="block w-full transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 border-gray-300"
                    type="text" />
            </div>
            <div class="flex mb-3">
                <input
                    wire:model="token"
                    placeholder="Insert Your Token Here..."
                    class="block w-full transition duration-75 rounded-lg shadow-sm outline-none focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 border-gray-300"
                    type="text" />
            </div>
            <button
                wire:click="start"
                class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                >Scan
            </button>
        </div>
    </x-filament::card>
</x-filament::widget>
