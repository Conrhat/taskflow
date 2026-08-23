@extends('layouts.base')

@section('body')
<div class="wrapper ">
        @include('partials.sidebar')
        <main class="main-panel transition-all duration-300 ease-in-out ml-[250px]">
            @include('partials.navbar')
            <div class="relative pt-[70px]">
                <div class="content mb-16 md:mb-0 p-6 md:p-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
@endsection