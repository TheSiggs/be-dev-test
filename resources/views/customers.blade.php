<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List - Backend Hero</title>

    <meta name="description" content="Browse the customer list of Your Company. Discover our valued customers and their details.">
    <meta name="keywords" content="customer list, company clients, business database, customers">
    <meta name="author" content="Backend Hero">
    <link rel="canonical" href="https://backendhero.com/customers" />

    <meta property="og:title" content="Customer List - Backend Hero">
    <meta property="og:description" content="Explore our valued customers. Find details about their business, contact, and more.">
    <meta property="og:url" content="https://backendhero.com/customers">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://media2.dev.to/dynamic/image/width=1080,height=1080,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fi%2Faoyc8zzuaton01hno671.png">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Customer List - Backend Hero">
    <meta name="twitter:description" content="Discover our valued customers and their details.">
    <meta name="twitter:image" content="https://media2.dev.to/dynamic/image/width=1080,height=1080,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fi%2Faoyc8zzuaton01hno671.png">

    <meta name="robots" content="index, follow">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center p-6">

    <div class="bg-white shadow-md rounded-lg p-6 w-full">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Customer List</h1>

        <!-- Pagination Size Selection -->
        <div class="mb-4">
            <label for="perPage" class="font-medium text-gray-600">Rows per page:</label>
            <select id="perPage"
                    hx-get="/customers/list"
                    hx-target="#customers-table-body"
                    hx-trigger="change"
                    name="per_page"
                    class="border-gray-300 rounded-md p-2 text-gray-800">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>

        <!-- TODO: Responsivenes... -->
        <div class="w-full overflow-x-auto">
            <table class="table-auto w-full border border-gray-200 shadow-sm rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">First Name</th>
                        <th class="px-4 py-2">Last Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Gender</th>
                        <th class="px-4 py-2">Company</th>
                        <th class="px-4 py-2">City</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Website</th>
                    </tr>
                </thead>
                <tbody id="customers-table-body"
                       hx-get="/customers/list?per_page=5"
                       hx-trigger="load"
                       class="bg-white divide-y divide-gray-200">
                    <!-- Data loads here -->
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>

