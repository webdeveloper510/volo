@extends('layouts.admin')

@include('Chatify::layouts.headLinks')

@section('page-title', __('Messenger'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{__('Messenger')}}</li>
@endsection

@section('content')

        <div class="col-xl-12">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="messenger min-h-750 overflow-hidden " style="border: 1px solid #eee; border-right: 0;">
                        {{-- ----------------------Users/Groups lists side---------------------- --}}
                        <div class="messenger-listView">
                            {{-- Header and search bar --}}
                            <div class="m-header">
                                <nav>
                                    <nav class="m-header-right">
                                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                                    </nav>
                                </nav>
                                {{-- Search input --}}
                                <input type="text" class="messenger-search" placeholder="Search" />
                                {{-- Tabs --}}
                                <div class="messenger-listView-tabs"> <a href="#" @if($route
                                    == 'user') class="active-tab" @endif data-view="users"> <span
                                    class="far fa-clock"></span></a> <a href="#"
                                    @if($route == 'group') class="active-tab" @endif
                                    data-view="groups"> <span class="fas fa-users"></span>
                                    </a> </div>
                            </div>
                            {{-- tabs and lists --}}
                            <div class="m-body">
                                {{-- Lists [Users/Group] --}}
                                {{-- ---------------- [ User Tab ] ---------------- --}}
                                <div class="@if ($route == 'user') show @endif messenger-tab app-scroll mt-2"
                                    data-view="users">

                                    {{-- Favorites --}}
                                    <div class="favorites-section mt-2">
                                        <p class="messenger-title">{{ __('Favorites') }}</p>
                                        <div class="messenger-favorites app-scroll-thin"></div>
                                    </div>

                                    {{-- Saved Messages --}}
                                    {!! view('Chatify::layouts.listItem', ['get' => 'saved', 'id' => $id])->render() !!}

                                    {{-- Contact --}}
                                    <div class="listOfContacts"
                                        style="width: 100%;height: calc(100% - 200px);position: relative;"></div>


                                </div>

                                {{-- ---------------- [ Group Tab ] ---------------- --}}

                                <div class="all_members @if ($route == 'group') show @endif messenger-tab app-scroll mt-2"
                                    data-view="groups">
                                    {{-- items --}}
                                    <p style="text-align: center;color:grey;" class="mt-5">
                                        {{ __('Soon will be available') }}</p>
                                </div>
                                {{-- ---------------- [ Search Tab ] ---------------- --}}
                                <div class=" messenger-tab app-scroll mt-2" data-view="search">
                                    {{-- items --}}
                                    <p class="messenger-title">Search</p>
                                    <div class="search-records">
                                        <p class="message-hint center-el"><span>Type to search..</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ----------------------Messaging side---------------------- --}}
                        <div class="messenger-messagingView">
                            {{-- header title [conversation name] amd buttons --}}
                            <div class="m-header m-header-messaging">
                                <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                                    {{-- header back button, avatar and user name --}}
                                    <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                                        <div class="avatar av-s header-avatar"
                                            style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                                        </div>
                                        <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                                    </div>
                                    {{-- header buttons --}}
                                    <nav class="m-header-right">
                                        <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                                        {{-- <a href="/"><i class="fas fa-home"></i></a> --}}
                                        <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                                    </nav>
                                </nav>
                                {{-- Internet connection --}}
                                <div class="internet-connection">
                                    <span class="ic-connected">{{ __('Connected') }}</span>
                                    <span class="ic-connecting">{{ __('Connecting...') }}</span>
                                    <span
                                        class="ic-noInternet">{{ __('Please add pusher settings for using messenger') }}</span>
                                </div>
                            </div>

                            {{-- Messaging area --}}
                            <div class="m-body messages-container app-scroll">
                                <div class="messages">
                                    <p class="message-hint center-el"><span>Please select a chat to start messaging</span>
                                    </p>
                                </div>
                                {{-- Typing indicator --}}
                                <div class="typing-indicator">
                                    <div class="message-card typing">
                                        <div class="message">
                                            <span class="typing-dots">
                                                <span class="dot dot-1"></span>
                                                <span class="dot dot-2"></span>
                                                <span class="dot dot-3"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Send Message Form --}}
                            @include('Chatify::layouts.sendForm')
                        </div>
                        {{-- ---------------------- Info side ---------------------- --}}
                        <div class="messenger-infoView app-scroll">
                            {{-- nav actions --}}
                            <nav>
                                <p>User Details</p>
                                <a href="#"><i class="fas fa-times"></i></a>
                            </nav>
                            {!! view('Chatify::layouts.info')->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
@include('Chatify::layouts.modals')
@push('custom-script')
    @include('Chatify::layouts.footerLinks')
@endpush
