<?php declare(strict_types=1);

namespace FastBillSdk\Common;

class RecipientEntity
{
    /**
     * @var string
     */
    private $toEmailAddress = '';

    /**
     * @var string
     */
    private $ccEmailAddress = '';

    /**
     * @var string
     */
    private $bccEmailAddress = '';

    /**
     * @return string
     */
    public function getToEmailAddress(): string
    {
        return $this->toEmailAddress;
    }

    /**
     * @param string $toEmailAddress
     */
    public function setToEmailAddress(string $toEmailAddress)
    {
        $this->validateEmail($toEmailAddress);

        $this->toEmailAddress = $toEmailAddress;
    }

    /**
     * @return string
     */
    public function getCcEmailAddress(): string
    {
        return $this->ccEmailAddress;
    }

    /**
     * @param string $ccEmailAddress
     */
    public function setCcEmailAddress(string $ccEmailAddress)
    {
        $this->validateEmail($ccEmailAddress);

        $this->ccEmailAddress = $ccEmailAddress;
    }

    /**
     * @return string
     */
    public function getBccEmailAddress(): string
    {
        return $this->bccEmailAddress;
    }

    /**
     * @param string $bccEmailAddress
     */
    public function setBccEmailAddress(string $bccEmailAddress)
    {
        $this->validateEmail($bccEmailAddress);

        $this->bccEmailAddress = $bccEmailAddress;
    }

    private function validateEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Your provided email address ' . $email . ' is invalid');
        }
    }

    public function applyEmails(array &$data)
    {
        if ($this->getToEmailAddress()) {
            $data['RECIPIENT'][] = ['TO' => $this->getToEmailAddress()];
        }

        if ($this->getCcEmailAddress()) {
            $data['RECIPIENT'][] = ['CC' => $this->getCcEmailAddress()];
        }

        if ($this->getBccEmailAddress()) {
            $data['RECIPIENT'][] = ['BCC' => $this->getBccEmailAddress()];
        }
    }
}
