<?php
namespace MUM\TilAlumni\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplikationen Ursprung
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for Alumnis
 */
class AlumniRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    public function getAllDomiciles()
    {

        return $this->getAllFromField('city');
    }

    public function getAllZips()
    {

        return $this->getAllFromField('zip');
    }

    public function getAllUniversitys()
    {

        return $this->getAllFromField('university');
    }

    public function getAllCourses()
    {

        return $this->getAllFromField('university_course');
    }


    /**
     * @param $formArgs
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     *
     * Performs a request  on the database for search criteria in formArgs
     */
    public function findByFormArgs($formArgs)
    {

        foreach ($formArgs as $k => $v) {
            if (empty($v)) {
                unset($formArgs[$k]);
            }
        }

        $query = $this->createQuery();
        $fullConstraints = $this->createConstraints($formArgs, $query);
        if (!empty($fullConstraints)) {
            $query->matching($query->logicalAnd($fullConstraints));
        }
        //DebuggerUtility::var_dump($fullConstraints);
        return $query->execute();
    }


    protected function getAllFromField($field)
    {
        $query = $this->createQuery();
        $result = $query->execute(true);
        $all = array();
        foreach ($result as $row) {
            if (strpos($row[$field], '/') !== FALSE) {
                // merge all with an array keys equal to values
                $all = array_merge($all, array_combine(explode('/', $row[$field]), explode('/', $row[$field])));
            } elseif (strpos($row[$field], ',') !== FALSE) {
                // merge all with an array keys equal to values
                $all = array_merge($all, array_combine(explode(',', $row[$field]), explode(',', $row[$field])));
            } else {
                $all[$row[$field]] = $row[$field];
            }

        }
        return $all;
    }

    /**
     * @param $formArgs
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @return array
     * create constraints for findByFormArgs()
     * two different methods, one is called over submit of searchform,
     *
     */
    protected function createConstraints($formArgs, \TYPO3\CMS\Extbase\Persistence\QueryInterface $query)
    {
        $fullConstraints = array();
        foreach ($formArgs as $property => $value) {
            if (!empty($value)) {
                switch ($property) {
                    case 'city':
                    case 'zip':
                    case 'university':
                        $fullConstraints[] = $query->equals($property, $value);
                        break;
                    case 'universityCourse':
                        $operand = '%' . $value . '%';
                        $fullConstraints[] = $query->like($property, $operand, false);
                        break;
                    case 'network':
                    case 'studentCounseilling' :
                        $fullConstraints[] = $query->greaterThanOrEqual($property, $value);
                        break;


                }
            }
        }
        return $fullConstraints;
    }

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * all alumnis where network is set
     */
    public function findAllNetwork()
    {
        $query = $this->createQuery();
        $query->matching($query->greaterThan('network', 0));
        return $query->execute();
    }

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * all alumnis where studentCounseilling is set
     */
    public function findAllStudentCounseilling()
    {
        $query = $this->createQuery();
        $query->matching($query->greaterThan('studentCounseilling', 0));
        return $query->execute();
    }

}