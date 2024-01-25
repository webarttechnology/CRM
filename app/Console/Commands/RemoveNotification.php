<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Illuminate\Console\Command;
use Carbon\Carbon;

class RemoveNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'After 30 days, all notifications will be deleted.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $notificationsToDelete = Notification::where('created_at', '<', $thirtyDaysAgo)
            ->where('status', 'read')
            ->get();

        foreach ($notificationsToDelete as $notification) {
            $notification->delete();
        }

        $this->info('Notifications deleted successfully.');
        return Command::SUCCESS;
    }
}
