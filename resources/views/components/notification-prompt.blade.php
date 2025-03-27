<div id="pushNotificationPrompt" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <img src="https://cdn-icons-png.flaticon.com/128/1827/1827349.png" alt="Logo" class="w-12 h-12 mx-auto mb-3">
        <h2 class="text-lg font-semibold">Get breaking news alerts</h2>
        <p class="text-gray-600 text-sm">Stay updated with latest explainers, opinions and much more. Unsubscribe any time from your settings</p>
        <div class="mt-4 flex justify-center gap-4">
            <button onclick="denyNotifications()" class="px-4 py-2 border border-gray-400 rounded-md">Don't Allow</button>
            <button onclick="requestPermission()"  class="px-4 py-2 border border-gray-400 rounded-md">Allow</button>
        </div>
    </div>
</div>