<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <Link href="{{ route('categories.create') }}"
                class="text-blue-600 px-2 py-4  hover:bg-indigo-600  rounded-md">Create</Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$categories">
                @cell('action' $category)
                    <Link href="{{ route('categories.edit', $category->id) }}"
                        class="text-green-600 hover:text-green-300 font-semibold">
                    Edit
                    </Link>
                    {{-- <Link confirm="Delete Category..." confirm-text="Are you sure?" confirm-button="Yes"
                        cancel-button="Cancel!" href="{{ route('categories.destroy', $category->id) }}"
                        class="text-red-600 hover:text-red-300 font-semibold" method="DELETE" preserve-scroll>
                    Delete
                    </Link> --}}
                    <x-splade-form confirm="AreYou Sure You Want To Delete" Method="Delete" action="{{route('categories.destroy', $category->id) }}">
                       <button type="submit">Delete</button>
                    </x-splade-form>

                @endcell
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
