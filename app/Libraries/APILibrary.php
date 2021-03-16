<?php

namespace App\Libraries;

use \CloudConvert\Laravel\Facades\CloudConvert;
use \CloudConvert\Models\Job;
use \CloudConvert\Models\Task;

class APILibrary {

    public static function createJob($jobName, $fileName) {

        $job = self::getFileProcessJob($jobName);

        CloudConvert::jobs()->create($job);
        $inputStream = fopen(public_path().'/uploads/'.$fileName, 'r');
        $uploadTask = $job->getTasks()->whereName('uploading-the-file-'.$jobName)[0];

        CloudConvert::tasks()->upload($uploadTask, $inputStream);

        CloudConvert::jobs()->wait($job);
        return $job->getExportUrls()[0]->url;
    }

    public static function uploadAndConvertFile($jobName, $fileName) {
        return self::createJob($jobName, $fileName);
    }

    private static function getFileProcessJob($jobName): Job {
        return (new Job())
            ->addTask(new Task('import/upload','uploading-the-file-'.$jobName))
            ->addTask(
                (new Task('convert', 'converting-the-file-'.$jobName))
                    ->set('input', 'uploading-the-file-'.$jobName)
                    ->set('output_format', 'mp3')
            )
            ->addTask(
                (new Task('export/url', 'exporting-the-file-'.$jobName))
                    ->set('input', 'converting-the-file-'.$jobName)
            );
    }
}
