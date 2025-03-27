<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        $user = User::find(1);
        if ($user) {
            $user->update(['fcm_token' => $request->token, 'fcm_create_datetime' => date('Y-m-d H:i:s')]);
        }

        return response()->json(['success' => true, 'message' => 'Token saved successfully']);
    }

    public function removeToken(Request $request)
    {
        $user = User::find(1);
        if ($user) {
            $user->update(['fcm_token' => null, 'fcm_create_datetime' => null]);
        }

        return response()->json(['success' => true, 'message' => 'Token removed successfully']);
    }

    public function sendNotification(Request $request)
    {
        try {            
            $users = User::whereNotNull('fcm_token')->pluck('fcm_token');

            if($users){

                $googleClient = new GoogleClient();
                $googleClient->setAuthConfig(storage_path('app/firebase/service-account.json'));
                $googleClient->addScope('https://www.googleapis.com/auth/firebase.messaging');

                $accessToken = $googleClient->fetchAccessTokenWithAssertion()["access_token"];
          
                $fcmUrl = "https://fcm.googleapis.com/v1/projects/proper-1f6f5/messages:send";

                $dataT = [
                    "message" => [
                        "token" => '',
                        "data" => [
                            "title" => $request->title,
                            "body" => $request->body,
                            "icon" => 'https://cdn-icons-png.flaticon.com/128/1827/1827349.png',
                            "image" => 'https://cdn3.notifyvisitors.com/blog/wp-content/uploads/2022/06/chrome_rich_push_notifications.jpg',
                            "url" => 'https://developer.chrome.com/blog/push-notifications-on-the-open-web',
                            "actions" => json_encode([
                                ["action" => "open_url", "title" => "Open"],
                                ["action" => "dismiss", "title" => "Dismiss"]
                            ])
                        ]
                    ]
                ];

                $responses = [];
                    foreach ($users->toArray() as $token) {

                        $dataT["message"]["token"] = $token;

                        $response = Http::withHeaders([
                            "Authorization" => "Bearer $accessToken",
                            "Content-Type"  => "application/json"
                        ])->post($fcmUrl, $dataT);

                        $responses[] = $response->json();
                    }

                    \Log::info($responses);

                return back()->with('success', 'Notification sent!');
            } else {
                return back()->with('error', 'Something went wrong, please try again');
            }
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        } 
    }
}
