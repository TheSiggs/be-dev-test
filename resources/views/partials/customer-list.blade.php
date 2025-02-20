@foreach($customers as $customer)
    <tr class="hover:bg-gray-100 transition ">
        <td class="border px-4 py-2 text-center">{{ $customer->id }}</td>
        <td class="border px-4 py-2">{{ $customer->first_name }}</td>
        <td class="border px-4 py-2">{{ $customer->last_name }}</td>
        <td class="border px-4 py-2">{{ $customer->email }}</td>
        <td class="border px-4 py-2">{{ $customer->gender }}</td>
        <td class="border px-4 py-2">{{ $customer->company }}</td>
        <td class="border px-4 py-2">{{ $customer->city }}</td>
        <td class="border px-4 py-2">{{ $customer->title }}</td>
        <td class="border px-4 py-2 w-64 overflow-hidden text-ellipsis whitespace-nowrap">
            <a href="{{ parse_url($customer->website, PHP_URL_SCHEME) . '://' . parse_url($customer->website, PHP_URL_HOST) }}">
                {{ parse_url($customer->website, PHP_URL_HOST) }}
            </a>
        </td>
    </tr>
@endforeach

<tr>
    <td colspan="9" class="px-4 py-2 text-center bg-gray-100">
        <div class="flex justify-center gap-4 items-center py-2">
            @if ($customers->previousPageUrl())
                <button
                    hx-get="{{ $customers->previousPageUrl() . '&per_page=' . $perPage }}"
                    hx-target="#customers-table-body"
                    hx-push-url="false"
                    class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-600 transition">
                    Previous
                </button>
            @endif

            <span class="text-gray-800">Page {{ $customers->currentPage() }} of {{ $customers->lastPage() }}</span>

            @if ($customers->nextPageUrl())
                <button
                    hx-get="{{ $customers->nextPageUrl() . '&per_page=' . $perPage }}"
                    hx-target="#customers-table-body"
                    hx-push-url="false"
                    class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-600 transition">
                    Next
                </button>
            @endif
        </div>
    </td>
</tr>

