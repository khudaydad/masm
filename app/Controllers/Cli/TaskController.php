<?php

namespace App\Controllers\Cli;

use App\Controllers\BaseController;
use App\Events\SubscriptionToVerify;
use App\Models\Device;
use Fiber;

class TaskController extends BaseController
{
    public function index()
    {
        $this->endExpiredSubscriptions();
    }

    public function endExpiredSubscriptions()
    {
        $startTime = microtime(true);

        $db = \Config\Database::connect();
        $builder = $db->table('subscriptions');

        $offset = 0;
        $chunkSize = 1000;
        $i = 1;
        $queue = [];
        $totalRowCount = 0;

        $countAll = $builder->where(['end_date <' => date('Y-m-d'), 'status' => 'active'])->countAllResults();
        log_message('debug', 'End subscription started. ' . $countAll);
        do {
            $rows = $builder->where(['end_date <' => date('Y-m-d'), 'status' => 'active'])->limit($chunkSize, $offset)->get()->getResultArray();

            $rowCount = count($rows);
            $totalRowCount += $rowCount;
            log_message('debug', $i . '. Chunk start. ChunkCount: ' . $rowCount . ' TotalChunkCount: ' . $totalRowCount);
            //log_message('debug', 'SQL:'.  $db->lastQuery);

            foreach ($rows as $row) {
                if (!in_array($row['id'], $queue)) {
                    $builder->where('id', $row['id'])->update(['status' => 'expired']);
                }
                /*if (in_array($row['id'], $queue)) {
                    log_message('debug', 'Try to end subscribe twice. RowId: ' . $row['id']);
                } else {
                    $queue[] = $row['id'];
                    $fiber = new Fiber(function () use ($db, $builder, $row) {
                        $builder->where('id', $row['id'])->update(['status' => 'expired']);
                    });
                    $fiber->start();
                }*/
            }

            //$offset += $chunkSize;
            log_message('debug', $i++ . '. Chunk finish');
            log_message('debug', '------------------------------------------------------------------');

        } while ($rowCount > 0);
        log_message('debug', 'End subscription finished. RowCount: ' . $totalRowCount . ' QueueCount: '.count($queue));

        $endTime = microtime(true);
        log_message('debug', 'Execution time: ' . round(($endTime - $startTime), 2) . ' seconds');
    }
}
