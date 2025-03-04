<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Interns;

class UpdateInternStatus extends Command
{
    protected $signature = 'interns:update-status';
    protected $description = 'Update intern status based on end_date';

    public function handle()
    {
        // Update status menjadi Nonactive jika end_date sudah terlewati
        $updatedCount = Interns::where('end_date', '<', now())
            ->where('status', 'Active')
            ->update(['status' => 'Nonactive']);

        $this->info("Updated $updatedCount intern(s) status to Nonactive.");
    }
}
