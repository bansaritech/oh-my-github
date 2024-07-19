<?php

namespace App\Filament\Widgets;

use App\Models\Scan;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class StartScan extends Widget
{
    protected static string $view = 'filament.widgets.start-scan';

    public $token = '';
    public $username = '';

    public function start()
    {
        // Make an entry in scan table
        $scan = new Scan();
        $scan->scan_on = $this->username;
        $scan->user_id = Auth::id();
        $scan->save();

        // Dispatch scan request job to queue
        dispatch(new ScanProfile($this->token, $scan->id));

        // Send notification that scan will be queued !
        Notification::make() 
            ->title('Scan request has been queued!')
            ->success()
            ->send(); 
    }

}
