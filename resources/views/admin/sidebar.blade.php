<!-- <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 hidden lg:block">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-gray-800">{{ config('app.name') }}</h2>
    </div>
    <nav class="mt-4 px-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            Dashboard
        </a>
        
        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            User Management
        </a>
        
        <a href="{{ route('admin.employees.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.employees.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            Employees
        </a>
        
        <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            Inventory
        </a>
        
        <a href="{{ route('admin.finance.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.finance.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            Finance
        </a>
        
        <a href="{{ route('admin.audit-logs.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.audit-logs.*') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50' }}">
            Audit Logs
        </a>
    </nav>
</aside> -->