<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard(Request $request)
    {
        $totalUsers = User::where('role', 'user')->count();
        $onlineUsers = User::where('role', 'user')
            ->whereNotNull('last_activity')
            ->where('last_activity', '>=', now()->subMinutes(30))
            ->count();
        
        $offlineUsers = $totalUsers - $onlineUsers;

        $users = User::where('role', 'user')
            ->orderBy('last_activity', 'desc')
            ->paginate(10);

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'onlineUsers' => $onlineUsers,
            'offlineUsers' => $offlineUsers,
            'users' => $users,
        ]);
    }

    /**
     * Show users list for management
     */
    public function users(Request $request)
    {
        $search = $request->get('search');
        $query = User::where('role', 'user');

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->paginate(15);

        return view('admin.users', compact('users', 'search'));
    }

    /**
     * Update user's username/name
     */
    public function updateUsername(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update(['name' => $request->name]);

        return back()->with('success', 'Username berhasil diubah');
    }

    /**
     * Get online users count (API endpoint)
     */
    public function getOnlineCount()
    {
        $count = User::where('role', 'user')
            ->whereNotNull('last_activity')
            ->where('last_activity', '>=', now()->subMinutes(30))
            ->count();

        return response()->json(['online' => $count]);
    }

    /**
     * Get total users count (API endpoint)
     */
    public function getTotalCount()
    {
        $this->authorize('viewDashboard', auth()->user());

        $count = User::where('role', 'user')->count();

        return response()->json(['total' => $count]);
    }

    /**
     * Update last activity
     */
    public function updateActivity(Request $request)
    {
        if (auth()->check()) {
            auth()->user()->update(['last_activity' => now()]);
        }

        return response()->json(['success' => true]);
    }
}
