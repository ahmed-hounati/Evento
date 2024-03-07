<x-app-layout>
    <div class="min-h-screen pb-3 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Add new event</h2>

        <form method="POST" action="{{ route('events.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="title">Title</label>
                    <input id="title" name="title" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="description">Description</label>
                    <input id="description" type="text" name="description" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="date">Date</label>
                    <input id="date" type="date" name="date" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="place">Place</label>
                    <input id="place" type="text" name="place" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <x-input-error :messages="$errors->get('place')" class="mt-2" />
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="availablePlaces">Available Places</label>
                    <input id="availablePlaces" type="number" name="availablePlaces" min="0" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <x-input-error :messages="$errors->get('availablePlaces')" class="mt-2" />
                </div>
                <div class="">
                    <x-input-label for="auto_confirmation" />
                    <select id="auto_confirmation" name="auto_confirmation" class="block w-full mt-1">
                        <option value="0">Manual validation</option>
                        <option value="1">Automatic confirmation</option>
                    </select>
                </div>
                <input class="hidden" name="organizer_id" value="{{auth()->user()->id}}">
                <div>
                    <label for="category" class="text-gray-700 dark:text-gray-200">Categories:
                    <select name="category_id"
                            class=" text-gray-700 border rounded w-full sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4 py-2 px-3 focus:outline-none focus:ring
                            focus:border-blue-300">
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">
                                {{ $categorie->name }}
                            </option>
                        @endforeach
                    </select>
                    </label>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>
