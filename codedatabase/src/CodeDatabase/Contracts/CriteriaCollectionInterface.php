<?php

namespace CodePress\CodeDatabase\Contracts;

interface CriteriaCollectionInterface
{
    public function addCriteria(CriteriaInterface $criteriaInterface);

    public function getCriteriaCollection();

    public function getByCriteria(CriteriaInterface $criteriaInterface);

    public function applyCriteria();
}