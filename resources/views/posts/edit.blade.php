<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Post') }}
            </h2>
            <Link href="{{ route('posts.create') }}"
                class="px-2 py-4 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">Create</Link>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-form :default="$post" method="PUT" :action="route('posts.update', $post->id)"
                class="max-w-md mx-auto p-4 bg-white rounded-md">
                <x-splade-select name="category_id" :options="$categories" label="Category" choices />
                <x-splade-input name="title" label="Title" />
                <x-splade-input name="slug" label="Slug" />
                <x-splade-input name="date" label="Date" date/>
                <x-splade-checkbox name="active" label="Active?" />
                <x-splade-textarea name="description" label="Description" autosize />

                <x-splade-submit class="mt-4" />
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
