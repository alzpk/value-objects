<?php

namespace Alzpk\ValueObjets;

interface ValueObject
{
    public function isSame(ValueObject $object): bool;
}