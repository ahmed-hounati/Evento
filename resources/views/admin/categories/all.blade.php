<x-app-layout>
    <div class="p-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
            @foreach($categories as $category)
            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$category->name}}</h5>
                <div class="flex justify-between">
                    <a href="{{ route('categories.edit', $category->id) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update</a>
                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <a href="/categories/create"
           class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 fixed bottom-4 right-4"><i
                class="fa-solid fa-plus fa-xl"></i></a>
    </div>
</x-app-layout>
