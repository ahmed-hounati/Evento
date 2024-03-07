<x-app-layout>
    <div class="py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                @foreach($events as $event)
                    <div class="max-w-2xl px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{$event->date}}</span>
                            <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500" tabindex="0" role="button">{{$event->category_name}}</a>
                        </div>

                        <div class="mt-2">
                            <a href="#" class="text-xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline" tabindex="0" role="link">{{$event->title}}</a>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <a href="/events/{{$event->id}}/show" class="mb-4 text-blue-600 dark:text-blue-400 hover:underline" tabindex="0" role="link">Read more</a>
                            <div class="flex items-center">
                                <a class="font-bold text-gray-700 cursor-pointer dark:text-gray-200" tabindex="0" role="link">{{$event->organizer_name}}</a>
                            </div>
                        </div>
                        @if($event->valid)
                            <p class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Already valid</p>
                        @else
                            <form action="{{ route('event.valid', $event->id) }}" method="POST">
                                @csrf
                                <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Valid</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
