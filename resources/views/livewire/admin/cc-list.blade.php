<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold text-gray-700 mb-6">Citizen’s Charter (CC) Responses</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">Customer Type</th>
                <th class="border border-gray-300 px-4 py-2 text-left">CC1 - Awareness</th>
                <th class="border border-gray-300 px-4 py-2 text-left">CC2 - Visibility</th>
                <th class="border border-gray-300 px-4 py-2 text-left">CC3 - Usage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ratings as $rating)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $rating->customer_type }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($rating->cc1 == 1)
                            Yes, aware before my transaction
                        @elseif($rating->cc1 == 2)
                            Yes, aware when I saw the CC
                        @elseif($rating->cc1 == 3)
                            No, not aware
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($rating->cc2 == 1)
                            Yes, the CC was easy to find
                        @elseif($rating->cc2 == 2)
                            Yes, but hard to find
                        @elseif($rating->cc2 == 3)
                            No, I did not see the CC
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($rating->cc3 == 1)
                            Yes, I was able to use CC
                        @elseif($rating->cc3 == 2)
                            No, I was unable to use the CC
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
