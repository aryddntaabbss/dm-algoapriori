<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    {{-- Body Start --}}
    <div class="py-6">
        <div class="max-w-screen mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                @include('components.data-tabel')
            </div>
        </div>
    </div>
    {{-- Body End --}}
</x-app-layout>