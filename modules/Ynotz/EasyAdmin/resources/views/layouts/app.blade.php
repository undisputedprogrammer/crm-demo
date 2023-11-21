<!DOCTYPE html>
<html x-data="{theme: $persist('newdark'), href: '', currentpath: '{{url()->current()}}', currentroute: '{{ Route::currentRouteName() }}', compact: $persist(false)}"
@themechange.window="theme = $event.detail.darktheme ? 'newdark' : 'cmyk';" lang="{{ str_replace('_', '-', app()->getLocale()) }}"
x-init="window.landingUrl = '{{url()->full()}}'; window.landingRoute = '{{ Route::currentRouteName() }}'; window.renderedpanel = 'pagecontent';"
@pagechanged.window="
currentpath=$event.detail.currentpath;
currentroute=$event.detail.currentroute;"
@routechange.window="currentroute=$event.detail.route;"
:data-theme="theme">
    <head>
        <title>{{ config('app.name', 'CRAFT Hospital and Research Centre') }}</title>
        <link rel="shortcut icon" type="image/jpg" href="{{asset('images/favicon.ico')}}"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('css')
        @stack('header_js')
    </head>
    <body x-data="initPage" x-init="initAction();"
        @linkaction.window="initialised = false; fetchLink($event.detail);"
        @formsubmit.window="postForm($event.detail);"
        @popstate.window="historyAction($event)"
        class="font-sans antialiased text-sm transition-colors hide-scroll ">
        <div x-data ="{
            allChats : {},
            allLeads : null,
            name : '',
            leads : [],
            lead : [],
            remarks : [],
            answers: [],
            questions : [],
            followups : [],
            showresults : false,
            fromDate : null,
            toDate : null,
            searchtype : 'scheduled_date',
            searchResults : null,
            pagination_data : null,
            searchFormState: [],
            searchFilter : null,
            sidedrawer : false,
            latest : null,
            processing : false,
            unread_message_count : 0,
            pollingID : 0,
            ic_lastid: null,
            unread_ic_count: 0,
            formatDate(timestamp){
                    let date = new Date(timestamp);

                    let today = new Date();

                    let hours = date.getHours();
                    let amOrpm = 'AM'
                    if(hours >= 12){
                        amOrpm = 'PM';
                        hours = hours % 12 || 12;
                    }
                    minutes = date.getMinutes();

                    if(date.getDate() == today.getDate() && date.getMonth() == today.getMonth() && date.getFullYear() == today.getFullYear())
                    {
                        return 'Today '+`${hours}:${minutes.toLocaleString('en-US', { minimumIntegerDigits: 2 })} ${amOrpm}`;
                    }else{
                        let day = date.getDate();
                        let month = date.toLocaleString('en-US',{month:'short'});
                        let year = date.getFullYear();
                        return `${day} ${month} ${year} ${hours}:${minutes.toLocaleString('en-US', { minimumIntegerDigits: 2 })} ${amOrpm}`;
                    }
                },
                fetchLatest(){
                    if(this.latest == null){
                        axios.get('/fetch/latest').then((r)=>{
                            if(r.data != null){
                                this.latest = r.data.latest;
                            }else{
                                {{-- setTimeout(()=>{
                                    this.fetchLatest();
                                },2000); --}}
                            }
                            this.unread_message_count = r.data.unread_message_count;
                            this.pollingID = setInterval(function(){
                                $dispatch('checkforupdates');
                            },2000);
                        }).catch((c)=>{
                            console.log(c);
                        })
                    }
            }

        }"
        x-init="
            {{-- fetchLatest(); --}}
            setTimeout(() => {
                this.pollingID = setInterval(function(){
                $dispatch('checkforupdates');
            },2000);}, 1000);

        "
        @messengerlatest.window="
            latest = $event.detail.latest;
        "
        @checkforupdates.window="
        if(!processing){
            processing = true;
            axios.get('/api/messages/poll',{
                params:{
                    user_id : '{{Auth::user()->id}}',
                    latest : latest,
                    last_id: ic_lastid
                }
            }).then((r)=>{
                if(r.data.status == true){
                    let newMessages = r.data.new_messages;
                    if (r.data.new_messages.length > 0) {
                        unread_message_count += r.data.new_messages.length;
                        $dispatch('showtoast', {mode: 'success', message: 'Alert: New incoming messages.'});
                    }
                    newMessages.forEach((msg)=>{
                        $dispatch('notify',{lead_id: msg.lead_id, msg: msg});
                        if(allChats[msg.lead_id] != null && allChats[msg.lead_id] != undefined){
                            allChats[msg.lead_id].push(msg);
                        }
                        else{
                            console.log('Message from unknown lead');
                            console.log(msg);
                            allChats[msg.lead_id] = [];
                            allChats[msg.lead_id].push(msg);
                            if(allLeads != null){
                                let foundLead = allLeads.find(lead => lead.id == msg.lead_id);
                                if(!foundLead){
                                    allLeads[msg.lead_id] = msg.lead;
                                }
                            }
                        }
                        latest = msg.id;
                    })
                }
                else{
                }
                ic_lastid = r.data.internalChatsData.lastid;
                $dispatch('internalchats', {data: r.data.internalChatsData});
                if(currentroute != 'internal_chat.index') {
                    unread_ic_count += r.data.internalChatsData.messages.length;
                }
            }).catch((e)=>{
                console.log(e);
            });
            processing = false;
        }"

         class="min-h-screen bg-base-200 flex flex-col" >

            <main x-data="x_main" class="flex flex-col items-stretch  flex-grow w-full " x-init="isBreak = '{{Auth::user()->in_break}}';">
                <!-- Header -->
                <x-display.header :hospital="$hospital"/>

                <div x-data="{show: true}" x-show="show"
                @contentupdate.window="
                if ($event.detail.target == 'renderedpanel') {
                    show = false;
                    setTimeout(() => {
                        $el.innerHTML = $event.detail.content;
                        show = true;},
                        400
                    );
                }
                " id="renderedpanel"
                x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="translate-x-6"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-250"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="opacity-0 -translate-x-6"
                class="">
                @fragment('page-content')
                    {{ $slot }}
                @endfragment

                </div>
                <x-display.break-screen/>
            </main>
        </div>
        <x-easyadmin::display.notice />
        <x-easyadmin::display.toast />
        <x-display.loading/>


        @stack('js')

    </body>
</html>
