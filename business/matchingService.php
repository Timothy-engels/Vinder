<?php
// business/matchingService.php

require_once ('data/matchingDAO.php');

class matchingService {
    
    public function matchMetVdab (
        $id1,
        $id2,
        $status
    )
    {
        $matchDAO = new matchings();
        $match = $matchDAO -> Insert($id1, $id2, $status);
    }
    
}