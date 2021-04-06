<?php

declare(strict_types=1);

class Koality_MagentoPlugin_Model_RushHourHandler
{
    public function isRushHour(): bool
    {
        $currentWeekDay = date('w');
        $isWeekend      = ($currentWeekDay === 0 || $currentWeekDay === 6);
        $configGetter   = Mage::getModel('koality_magentoplugin/service_config');
        $useRushHour    = $configGetter->getDoesRushhourIncludeWeekends() || !$isWeekend;
        if ($useRushHour && $configGetter->getRushhourBegin() && $configGetter->getRushhourEnd()) {
            $currentTimeStamp       = Mage::getModel('core/locale')->storeTimeStamp();
            $timeStampOneHourAgo    = $currentTimeStamp - 3600;
            $beginRushHourTimeArray = explode(',', $configGetter->getRushhourBegin());
            $beginRushHourTimestamp = $this->getTimestampFromTimeArray($beginRushHourTimeArray);
            $endRushHourTimeArray   = explode(',', $configGetter->getRushhourEnd());
            $endRushHourTimestamp   = $this->getTimestampFromTimeArray($endRushHourTimeArray);

            return ($timeStampOneHourAgo > $beginRushHourTimestamp && $currentTimeStamp < $endRushHourTimestamp);
        }

        return false;
    }

    private function getTimestampFromTimeArray(array $timeArray): int
    {
        return strtotime($timeArray[0] . ':' . $timeArray[1] . ':' . $timeArray[2]);
    }

}
