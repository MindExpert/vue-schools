<?php

namespace App\Services;

use App\Jobs\BatchUpdates;

class UpdateService
{
    protected int $batchSize = 1000;
    protected array $currentBatch = [];

    public function addSubscriberToBatch($subscriber): void
    {
        $this->currentBatch[] = $subscriber;

        if (count($this->currentBatch) >= $this->batchSize) {
            $this->dispatchBatch();
        }
    }

    public function dispatchBatch(): void
    {
        if (! empty($this->currentBatch)) {
            $batchData = ['subscribers' => $this->currentBatch];

            BatchUpdates::dispatch($batchData);

            // Clear the current batch
            $this->currentBatch = [];
        }
    }

    public function __destruct()
    {
        // Ensure remaining items in the batch are processed before the script ends
        $this->dispatchBatch();
    }
}
