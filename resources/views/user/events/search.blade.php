<x-app-layout>
    <div class="py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        <form class="max-w-md mx-auto" action="{{route('user.search')}}" method="get">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search"  name="title" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

        <form class="max-w-md mx-auto mt-6" action="{{route('user.all')}}" method="get">
            <select name="category_name"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->name }}">
                        {{ $categorie->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class=" mt-4 focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Filter</button>
        </form>

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
                        @php
                            $userArchived = auth()->user() && auth()->user()->archive;
                        @endphp

                        @if (auth()->user())
                            @php
                                $reservation = auth()->user()->reservations()->where('event_id', $event->id)->first();
                            @endphp

                            @if($reservation)
                                @if($reservation->valid || $event->auto_confirmation)
                                    <a href="{{ route('event.ticket', $event->id) }}" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Show Ticket</a>
                                @else
                                    <p class="mt-4 focus:outline-none text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-500">Waiting for acceptance</p>
                                @endif
                            @else
                                @php
                                    $confirmedReservations = $event->reservations()->where('valid', 1)->count();
                                @endphp

                                @if($event->availablePlaces > $confirmedReservations)
                                    <form action="{{ route('event.book', $event) }}" method="POST">
                                        @csrf
                                        <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Reserve</button>
                                    </form>
                                @else
                                    <p class="mt-4 focus:outline-none text-red-500 hover:text-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-500">Sold Out</p>
                                @endif
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
