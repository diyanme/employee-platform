<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="mx-auto max-w-6xl px-6 py-10">

        <div class="mb-8 flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Employee Management
                </h1>

                <p class="mt-1 text-gray-600">
                    Manage your employees
                </p>
            </div>

            <a href="{{ route('employees.create') }}"
                class="rounded-lg bg-blue-600 px-5 py-2.5 font-medium text-white hover:bg-blue-700">
                + Add Employee
            </a>

        </div>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl bg-white shadow">

            <table class="w-full">

                <thead class="border-b bg-gray-50">

                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Name
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Employee Code
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Department
                        </th>

                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">
                            Actions
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($employees as $employee)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $employee->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $employee->employee_code }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $employee->email }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $employee->department }}
                            </td>

                            <td class="px-6 py-4 text-right">

                                <a href="{{ route('employees.edit', $employee) }}"
                                    class="mr-3 font-medium text-blue-600 hover:text-blue-800">
                                    Edit
                                </a>

                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="font-medium text-red-600 hover:text-red-800">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                No employees found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
