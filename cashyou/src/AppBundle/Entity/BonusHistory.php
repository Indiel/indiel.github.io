<?php

namespace AppBundle\Entity;

class BonusHistory
{
    /**
     * @var BonusHistoryRecord[]
     */
    protected $records;
    
    /**
     * @param BonusHistoryRecord[] $records
     */
    public function __construct($records = [])
    {
        $this->records = $records;
    }

    /**
     * @return BonusHistoryRecord[]
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * @param BonusHistoryRecord[] $records
     */
    public function setRecords($records)
    {
        $this->records = $records;
    }

    /**
     * @param $loanId
     * @return int
     */
    public function getLoanEarnedBonuses($loanId)
    {
        return array_sum(array_map(function(BonusHistoryRecord $record) {
            return $record->getEarned();
        }, array_filter($this->records, function(BonusHistoryRecord $record) use ($loanId) {
            return ($record->getLoanId() == $loanId) && $record->getEventId() && in_array($record->getEventId()->getValue(), [
                EventTypeId::REPAID_LOAN_EVENT,
            ]);
        })));
    }
}