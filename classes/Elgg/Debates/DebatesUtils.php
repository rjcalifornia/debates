<?php


namespace Elgg\Debates;
use Webmozart\Json\JsonDecoder;

class DebatesUtils{

    public function decodeJsonFile($filename){
        $decoder = new JsonDecoder();
        $data = $decoder->decodeFile(__DIR__ .'/' . $filename);
        return $data;
    }
    
    public function getDebateVotes($entity){
        $totalYes = $entity->getAnnotationsSum(['annotation_name' => 'yes']); 
        $totalNo = $entity->getAnnotationsSum(['annotation_name' => 'no']);
        $totals = ['yes'=> $totalYes, 'no'=> $totalNo, 'total_votes' => ($totalNo + $totalYes)];
        
        return $totals;
    }
}