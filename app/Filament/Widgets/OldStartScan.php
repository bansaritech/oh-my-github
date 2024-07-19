<?php

namespace App\Filament\Widgets;

use App\Jobs\ScanProfile;
use App\Models\Scan;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StartScan extends Widget
{
    public $token = '';
    public $username = '';

    public function start()
    {
        $validator = Validator::make([
            'username' => $this->username,
            'token' => $this->token,
        ], [
            'username' => 'required',
            'token' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Send error notification
            Notification::make()
                ->title('Validation Error')
                ->danger() // Use danger instead of error
                ->body('Username and Token are required.') // Use body instead of error
                ->send();

            return;
        }

        // If validation passes, proceed to create scan
        $this->createScan();
    }
    
    protected function createScan()
    {
        // Create scan entry
        $scan = new Scan();
        $scan->scan_on = $this->username;
        $scan->user_id = Auth::id();
        $scan->save();

        // Dispatch scan request job to queue
        dispatch(new ScanProfile($this->token, $scan->id));

        // Send success notification
        Notification::make()
            ->title('Scan request has been queued!')
            ->success()
            ->send();
    }

    protected static string $view = 'filament.widgets.start-scan';
}
