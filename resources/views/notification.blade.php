@extends('layouts.app')

@section('content')

    <x-notification-prompt />

    <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">

        <div class="w-full">

            <x-flash-messages />

            <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl mb-5">Notification</h2>

            <form action="{{ route('send.notification') }}" method="POST" class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-2">
                    <label  class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" value="Notification Title">
                </div>
                <div class="mb-6">
                    <label  class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="body" name="body">Notification Body</textarea>
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Send Notification</button>
                    <button type="button" onclick="requestPermission()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Subscribe Notification</button>
                    <button type="button" onclick="unsubscribeUser()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Unsubscribe Notification</button>
                    
                </div>
            </form>

            
        </div>
    </div>
@endsection

@push('scripts')

@include('elements.firebase_config')
    <script>
        console.log(' Notification.permission => ',Notification.permission);
        if (Notification.permission !== 'granted') {
            setTimeout(function(){
                document.getElementById('pushNotificationPrompt').classList.remove("hidden");
            }, 500); 
        }
    </script>
@endpush