@extends('layouts.app')
@section('content')
    <div class="flex bg-gray-100 border-b border-gray-300 py-4">
        <div class="container mx-auto flex justify-between">
            <div class="flex">
                <router-link class="mr-4" to='/Posts' exact>Posts</router-link>
                <router-link to='/Posts/myPosts'>My Posts</router-link>
            </div>
            <div class="flex">
            @guest
                <router-link class="mr-4" to='/login' exact>Login</router-link>
                <router-link to='/register'>Register</router-link>
            @else
                <router-link class="mr-4" to='/dashboard' exact>Dashboard</router-link>
            @endguest
            </div>
        </div>
    </div>
    <div class="container mx-auto py-2">
        <router-view></router-view>
    </div>

@endsection
