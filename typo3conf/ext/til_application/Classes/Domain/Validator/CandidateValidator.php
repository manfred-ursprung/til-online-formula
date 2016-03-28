<?php
namespace MUM\TilApplication\Domain\Validator;


/**
 * Created by PhpStorm.
 * User: manfred
 * Date: 26.03.16
 * Time: 15:38
 */
class CandidateValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator
{
    /**
     * @param $candidate mixed
     * @return bool
     */
    public function isValid($candidate) {
        if (! $candidate instanceof \MUM\TilApplication\Domain\Model\Candidate) {
            $this->addError('The given Object is not a User.', 1262341470);
            return FALSE;
        }
        return TRUE;
    }

}