<nav x-data="{ open: false, profileOpen: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-200/50 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side: Logo + Nav Links -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->user()->hasRole('admin') 
                                ? route('admin.dashboard') 
                                : route('kasir.dashboard') }}"
                       class="group transition-all duration-300 ease-out hover:scale-105">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 group-hover:text-blue-600 transition-colors duration-300" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:space-x-1 sm:ms-10">
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            {{ __('Users') }}
                        </a>
                        <a href="{{ route('admin.employees.index') }}"
                           class="nav-link {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                            {{ __('Employees') }}
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                           class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            {{ __('Products') }}
                        </a>
                        <a href="{{ route('admin.finance.index') }}"
                           class="nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}">
                            {{ __('Finance') }}
                        </a>
                        <a href="{{ route('admin.audit-logs.index') }}"
                           class="nav-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}">
                            {{ __('Audit Logs') }}
                        </a>
                    @elseif(auth()->user()->hasRole('kasir'))
                        <a href="{{ route('kasir.dashboard') }}"
                           class="nav-link {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('kasir.transactions.index') }}"
                           class="nav-link {{ request()->routeIs('kasir.transactions.*') ? 'active' : '' }}">
                            {{ __('Transactions') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right side: User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" x-data="{ profileOpen: false }">
                    <button @click="profileOpen = ! profileOpen"
                            class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200 hover:border-gray-300 transition-all duration-300 hover:shadow-md">
                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-sm font-semibold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden lg:inline-block">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-300"
                             :class="{'rotate-180': profileOpen}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="profileOpen"
                         @click.away="profileOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                         class="absolute mt-3 w-56 rounded-2xl bg-white shadow-xl border border-gray-100 py-2 overflow-hidden"
                         style="display: none;">
                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profile</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Log Out</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger Menu Button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2.5 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex transition-transform duration-300"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="inline-flex transition-transform duration-300"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}"
         class="hidden sm:hidden bg-gradient-to-b from-gray-50 to-white border-t border-gray-200/50">
        <div class="px-4 pt-3 pb-4 space-y-1">
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}"
                   class="mobile-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="mobile-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    {{ __('Users') }}
                </a>
                <a href="{{ route('admin.employees.index') }}"
                   class="mobile-nav-link {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                    {{ __('Employees') }}
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="mobile-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    {{ __('Products') }}
                </a>
                <a href="{{ route('admin.finance.index') }}"
                   class="mobile-nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}">
                    {{ __('Finance') }}
                </a>
                <a href="{{ route('admin.audit-logs.index') }}"
                   class="mobile-nav-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}">
                    {{ __('Audit Logs') }}
                </a>
            @elseif(auth()->user()->hasRole('kasir'))
                <a href="{{ route('kasir.dashboard') }}"
                   class="mobile-nav-link {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('kasir.transactions.index') }}"
                   class="mobile-nav-link {{ request()->routeIs('kasir.transactions.*') ? 'active' : '' }}">
                    {{ __('Transactions') }}
                </a>
            @endif
        </div>

        <!-- Mobile User Info + Menu -->
        <div class="pt-4 pb-1 border-t border-gray-200/50 bg-white/50">
            <div class="px-4 mb-3">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate max-w-[180px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="px-2 space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profile</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Log Out</span>
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        nav[x-cloak] { display: none !important; }

        /* Desktop Navigation Links */
        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover {
            color: #2563eb;
            background: #eff6ff;
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: #2563eb;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            font-weight: 600;
            box-shadow: 0 1px 3px rgba(37, 99, 235, 0.1);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -0.75rem;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            border-radius: 1px;
        }

        /* Mobile Navigation Links */
        .mobile-nav-link {
            display: block;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .mobile-nav-link:hover {
            background: #f3f4f6;
            color: #2563eb;
            transform: translateX(4px);
        }

        .mobile-nav-link.active {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        /* Smooth transitions */
        * {
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>
</nav>