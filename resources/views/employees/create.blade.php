<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Employee</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="mx-auto max-w-2xl px-6 py-10">

        <div class="mb-8">
            <a href="{{ route('employees.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                ← Back to Employees
            </a>

            <h1 class="mt-4 text-3xl font-bold text-gray-900">
                Add Employee
            </h1>

            <p class="mt-1 text-gray-600">
                Create a new employee record.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                <ul class="list-disc pl-5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-xl bg-white p-8 shadow">

            <form action="{{ route('employees.store') }}" method="POST">

                @csrf

                <div class="space-y-6">

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                            placeholder="John Doe">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Employee Code
                        </label>

                        <input type="text" name="employee_code" value="{{ old('employee_code') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                            placeholder="EMP001">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                            placeholder="john@example.com">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Department
                        </label>

                        <input type="text" name="department" value="{{ old('department') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                            placeholder="Engineering">
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3">

                    <a href="{{ route('employees.index') }}"
                        class="rounded-lg border border-gray-300 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 font-medium text-white hover:bg-blue-700">
                        Create Employee
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
