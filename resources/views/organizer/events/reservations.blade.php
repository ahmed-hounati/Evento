<x-app-layout>
    <div class="py-12 ml-4">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
            @foreach($reservations as $reservation)
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-4 pt-4">
                    </div>
                    <div class="flex flex-col items-center gap-4 pb-10">
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$reservation->user->name}}</h5>
                        <div class="flex justify-between">
                            @if($reservation->valid)
                                <p class="mt-4 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Accepted</p>
                            @else
                                <form method="POST" action="{{ route('reservation.valid', $reservation->id) }}">
                                    @csrf
                                    <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Valid</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
