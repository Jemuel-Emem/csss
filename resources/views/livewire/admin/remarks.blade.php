<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Ratings</h2>

    @if($ratings->isEmpty())
        <p>No ratings found.</p>
    @else
        <table class="table-auto w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Age</th>
                    <th class="px-4 py-2">Sex</th>
                    <th class="px-4 py-2">Region</th>
                    <th class="px-4 py-2">Agency Visited</th>
                    <th class="px-4 py-2">Service Availed</th>
                    <th class="px-4 py-2">Customer Type</th>
                    <th class="px-4 py-2">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ratings as $rating)
                    <tr class="bg-white border-b">
                        <td class="px-4 py-2 text-center">{{ $rating->age }}</td>
                        <td class="px-4 py-2 text-center">{{ $rating->sex }}</td>
                        <td class="px-4 py-2 text-center">{{ $rating->region }}</td>
                        <td class="px-4 py-2 text-center">{{ $rating->office->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-center">{{ $rating->service->name ?? 'N/A' }}</td>

                        <td class="px-4 py-2 text-center">{{ $rating->customer_type }}</td>
                        <td class="px-4 py-2 text-center">{{ $rating->remarks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
