@props(['hospital'])
<div class="w-full  top-0 left-0 flex items-center justify-between h-14  bg-base-300 z-10 px-4 lg:px-10">


    <div class="flex items-center space-x-3">
        <button class=" md:hidden w-7 h-7 relative focus:outline-none " @click.prevent.stop="sidedrawer = !sidedrawer">
            <span class="sr-only">sidedrawer menu</span>
            <div
                class="block w-5 absolute left-1/2 top-1/2 text-base-content  transform  -translate-x-1/2 -translate-y-1/2">
                <span aria-hidden="true"
                    class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                    :class="{ 'rotate-45': sidedrawer, ' -translate-y-1.5': !sidedrawer }"></span>
                <span aria-hidden="true"
                    class="block absolute  h-0.5 w-5 bg-current   transform transition duration-500 ease-in-out"
                    :class="{ 'opacity-0': sidedrawer }"></span>
                <span aria-hidden="true"
                    class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out"
                    :class="{ '-rotate-45': sidedrawer, ' translate-y-1.5': !sidedrawer }"></span>
            </div>
        </button>

        <a href=""
            @click.prevent.stop="$dispatch('linkaction',{link: '{{ route('overview') }}', route: 'overview', fragment: 'page-content'})"
            class="text-xl font-bold flex items-center ">
            <img src="{{asset('images/ynotz it solutions-01.webp')}}" class="h-12 mr-2" alt="crm-app Logo">
            {{-- <span class="self-center text-neutral-content whitespace-nowrap uppercase">{{$hospital->name}}</span> --}}
        </a>
    </div>


    <div class="hidden md:flex">
        <div class="tabs mx-auto font-medium">

            <a href=""
                @click.prevent.stop="$dispatch('linkaction',{
                link:'{{ route('overview') }}',
                route: 'overview',
                fragment: 'page-content',
                fresh : true
            })"
                class="tab text-base-content "
                :class="currentroute == 'overview' ? ' border-b-[3px] border-primary text-opacity-100' :
                    'opacity-60 hover:opacity-100'">Dashboard</a>

            <a href=""
                @click.prevent.stop="$dispatch('linkaction',{
                link:'{{ route('fresh-leads') }}',
                route: 'fresh-leads',
                fragment: 'page-content',
                fresh : true

            })"
                class="tab text-base-content "
                :class="currentroute == 'fresh-leads' ? ' border-b-[3px] border-primary opacity-100' :
                    'opacity-60 hover:opacity-100'">Leads</a>

            <a href=""
                @click.prevent.stop="$dispatch('linkaction',{
                link:'{{ route('followups') }}',
                route: 'followups',
                fragment: 'page-content',
                fresh: true

            })"
                class="tab  text-base-content "
                :class="currentroute == 'followups' ? ' border-b-[3px] border-primary opacity-100' :
                    'opacity-60 hover:opacity-100'">Follow
                ups</a>

            <a href=""
                @click.prevent.stop="$dispatch('linkaction',{
                link:'{{ route('search-index') }}',
                route: 'search-index',
                fragment: 'page-content'
            })"
                class="tab  text-base-content "
                :class="currentroute == 'search-index' ? ' border-b-[3px] border-primary opacity-100' :
                    'opacity-60 hover:opacity-100'">Search</a>

        </div>
    </div>
    <div class=" flex space-x-3 items-center">

        <label class="swap swap-rotate w-fit h-fit">

            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" class=" hidden" />

            <!-- sun icon -->
            <svg id="sun" @click.prevent.stop="$dispatch('themechange', {darktheme : false})"
                class=" fill-base-content w-6 h-6 " :class=" theme == 'newdark' ? ' swap-on' : ' swap-off' "
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
            </svg>

            <!-- moon icon -->
            <svg id="moon" @click.prevent.stop="$dispatch('themechange', {darktheme : true})"
                class=" fill-base-content w-6 h-6 " :class=" theme == 'cmyk' ? ' swap-on' : ' swap-off' "
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
            </svg>

        </label>
        <a href=""
        @click.prevent.stop="
            $dispatch('linkaction', {
                link: '{{route('messenger')}}', route: 'messenger', fresh: true, fragment: 'page-content'
            });"
            class="text-base-100 inline-block h-6 w-6 indicator">
            <span x-show="unread_message_count > 0" class="indicator-item badge-xs animate-pulse badge badge-secondary text-base-content font-medium" x-text="unread_message_count"></span>
            <img src="/images/whatsapp.png">
        </a>
        <a href=""
        @click.prevent.stop="
            $dispatch('linkaction', {
                link: '{{route('internal_chat.index')}}', route: 'internal_chat.index', fresh: true, fragment: 'page-content'
            });"
            class="text-base-100 inline-block h-6 w-6 indicator">
            <span x-show="unread_ic_count > 0" class="indicator-item badge-xs animate-pulse badge badge-info text-base-content font-medium" x-text="unread_ic_count"></span>
            <img src="/images/chat.png">
        </a>

        {{-- user dropdown --}}

        <div x-data="{
            show: false,
            toggle() {

                if (this.show) {
                    this.show = false;
                } else {
                    this.show = true;
                }

            }
        }" class="flex items-center md:order-2 relative sm:w-36">
            <button @click.prevent.stop="toggle()" type="button"
                class="flex mr-3 text-sm text-neutral-content space-x-1 bg-neutral-focus items-center rounded-2xl p-1 md:mr-0"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">sidedrawer user menu</span>
                <img class="w-8 h-8 rounded-full"
                    src="{{ auth()->user()->user_picture != null ? auth()->user()->user_picture['path'] : '/images/profile_img.png'}}" alt="user photo">
                <span class="px-1.5 min-w-20 hidden sm:flex">{{ auth()->user()->name }}</span>
            </button>
            <!-- Dropdown menu -->
            <div x-show="show" @click.outside="toggle()" x-transition
                class="z-50 absolute top-7 right-0 my-4 text-base list-none divide-y min-w-48  divide-gray-100 rounded-lg shadow "
                :class="theme == 'light' ? 'bg-base-200' : 'bg-neutral-focus'" id="user-dropdown">
                <div class="px-4 py-3 text-base-content">
                    {{-- <span class="block text-sm  ">Marketing Agent</span> --}}
                    <span class="block text-sm   truncate ">{{ auth()->user()->email }}</span>
                </div>
                <ul class="py-2 text-white" aria-labelledby="user-menu-button">

                    <li>
                        <a href="" @click.prevent.stop="$dispatch('linkaction',{link: '{{route('user.profile')}}', route: 'user.profile', fragment: 'page-content'})" class="block px-4 py-2 text-sm hover:text-primary hover:bg-base-100">Profile</a>
                    </li>

                    <li>
                        <a href=""
                            @click.prevent.stop="setBreakStartTime('{{route('break.in')}}')"
                            class="block px-4 py-2 text-sm hover:bg-base-100 hover:text-primary ">Take break</a>
                    </li>

                    <li>
                        <a href=""
                            @click.prevent.stop="$dispatch('linkaction',{link:'{{ route('user-password.reset') }}', route: 'user-password.reset', fragment: 'page-content'})"
                            class="block px-4 py-2 text-sm hover:bg-base-100 hover:text-primary ">Change password</a>
                    </li>
                    <li>
                        <a href="/logout" class="block px-4 py-2 text-sm text-error">Sign out</a>
                    </li>
                </ul>
            </div>


        </div>


    </div>

</div>
