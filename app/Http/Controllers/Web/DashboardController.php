<?php

namespace App\Http\Controllers\Web;

use App\Enums\DeliveryStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function __invoke()
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        return inertia('Dashboard', [
            'stats' => [
                ['name' => 'Total Emails Sent', 'stat' => $user?->emails()->where('status', DeliveryStatus::SENT)->count() ?? 0],
                ['name' => 'Total Emails Failed', 'stat' => $user?->emails()->where('status', DeliveryStatus::FAILED)->count() ?? 0],
                ['name' => 'Total Email Attachments', 'stat' => $user?->emails()->withCount('attachments')->pluck('attachments_count')->sum() ?? 0],
            ],
        ]);
    }
}
