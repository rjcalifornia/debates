<?php


namespace Elgg\Debates;
use Webmozart\Json\JsonDecoder;

class DebatesUtils{

    public function decodeJsonFile($filename){
        $decoder = new JsonDecoder();
        $data = $decoder->decodeFile(__DIR__ .'/../../../' . $filename);
        return $data;
    }
}