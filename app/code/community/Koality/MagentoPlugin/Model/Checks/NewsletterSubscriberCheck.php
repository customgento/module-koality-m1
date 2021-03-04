<?php

declare(strict_types=1);

use Koality_MagentoPlugin_Model_Result as Result;

class Koality_MagentoPlugin_Model_Checks_NewsletterSubscriberCheck
{
    public function getResult(): Result
    {
        $expectedMinNewsletterSubscriptions = Mage::getModel('koality_magentoplugin/service_config')
            ->getMinExpectedNewsletterSubsriptions();
        $currentNewsletterSubscriptions     = $this->getCurrentNewsletterSubscriptions();

        if ($currentNewsletterSubscriptions < $expectedMinNewsletterSubscriptions) {
            $newsletterSubscriptionsCheckResult = new Result(Result::STATUS_FAIL, Result::KEY_NEWSLETTER_TOO_FEW,
                'There were too few newsletter subscriptions yesterday.');
        } else {
            $newsletterSubscriptionsCheckResult = new Result(Result::STATUS_PASS, Result::KEY_NEWSLETTER_TOO_FEW,
                'There were enough newsletter subscriptions yesterday.');
        }

        $newsletterSubscriptionsCheckResult->setLimit($expectedMinNewsletterSubscriptions);
        $newsletterSubscriptionsCheckResult->setObservedValue($currentNewsletterSubscriptions);
        $newsletterSubscriptionsCheckResult->setObservedValueUnit('newsletters');
        $newsletterSubscriptionsCheckResult->setLimitType(Result::LIMIT_TYPE_MIN);
        $newsletterSubscriptionsCheckResult->setType(Result::TYPE_TIME_SERIES_NUMERIC);

        return $newsletterSubscriptionsCheckResult;
    }

    private function getCurrentNewsletterSubscriptions(): int
    {
        $toTime   = date("Y-m-d H:i:s");
        $fromTime = date('Y-m-d H:i:s', strtotime('-1 day'));

        return Mage::getModel('newsletter/subscriber')->getCollection()
            ->addFieldToFilter('change_status_at', ['from' => $fromTime, 'to' => $toTime])->getSize();
    }
}
