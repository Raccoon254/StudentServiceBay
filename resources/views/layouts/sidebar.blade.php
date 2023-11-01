<div class="drawer w-0 md:w-64 md:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="">

    </div>
    <div class="z-40 drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>

        <div class="menu overflow-clip p-4 pt-[70px] w-64 h-full bg-base-100 border-r border-gray-200 text-base-content gap-4 flex flex-col justify-start items-start">
            <!-- App Logo -->
            <div class="flex items-center w-full justify-center gap-4">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block w-[60px] fill-current text-gray-800" />
                </a>
            </div>

            <!-- Sidebar content here -->
            <a href="{{ route('dashboard') }}" class="side {{ Route::is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-home-lg"></i>
                <div class="">
                    Dashboard
                </div>
            </a>

            <a class="side" href="" >
                <i class="fa-regular fa-user"></i>
                <div class="">
                    Profile
                </div>
            </a>

            <a href="" class="side {{ Route::is('this') ? 'active' : '' }}">
                <i class="fa-solid fa-sheet-plastic"></i>
                <div class="">
                    Payments
                </div>
            </a>

            <a class="side" href="" >
                <i class="fa-regular fa-calendar"></i>
                <div class="">
                    Events
                </div>
            </a>

            <a class="side" href="" >
                <i class="fa-solid fa-circle-nodes"></i>
                <div class="">
                    Connect
                </div>
            </a>

            <a class="side" href="" >
                <i class="fa-solid fa-coins"></i>
                <div class="">
                    Income
                </div>
            </a>

            <a class="side" href="" >
                <i class="fa-regular fa-circle-user"></i>
                <div class="">
                    Account
                </div>
            </a>

        </div>
    </div>
</div>
