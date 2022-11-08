<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    public function markAllAsRead(){
       $user = Auth::user();
       
       $user->notifications->markAsRead();
       return redirect()->back();
    }


    public function markNotificationAsRead($id){


        $notification = Notification::findOrFail($id);
        
        $notification->read_at = now();
        $notification->save();
       
        return redirect()->back();
     }
}
