<?php

class SendEmailQueue {

    public function fire($job, $data)
    {
        // Process the job received from the queue
        Log::info('This is was written via the QueueDemo class at '.time().'.');
    }

}