<?php

namespace App\Observers;
use App\Models\AssignLog;
use App\Models\Assign;
use Illuminate\Support\Facades\Log;


class AssignObserver
{
    /**
     * Handle the Assign "created" event.
     *
     * @param  \App\Models\Assign  $assign
     * @return void
     */
    public function created(Assign $assign)
    {
        //
    }

    /**
     * Handle the Assign "updated" event.
     *
     * @param  \App\Models\Assign  $assign
     * @return void
     */
    public function updated(Assign $assign)
    {
        $changes = $assign->getDirty();

        if (!empty($changes)) {

            $log = AssignLog::create([
                'task_id' => $assign->id,
                'changes' => $changes,
            ]);


            Log::info('Task updated: ' . $assign->id, [
                'changes' => $changes,
            ]);

            
        }
    }

    /**
     * Handle the Assign "deleted" event.
     *
     * @param  \App\Models\Assign  $assign
     * @return void
     */
    public function deleted(Assign $assign)
    {
        //
    }

    /**
     * Handle the Assign "restored" event.
     *
     * @param  \App\Models\Assign  $assign
     * @return void
     */
    public function restored(Assign $assign)
    {
        //
    }

    /**
     * Handle the Assign "force deleted" event.
     *
     * @param  \App\Models\Assign  $assign
     * @return void
     */
    public function forceDeleted(Assign $assign)
    {
        //
    }
}
