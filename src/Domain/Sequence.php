<?php

namespace ADR\Domain;

use ADR\Filesystem\Workspace;
use DomainException;

/**
 * Represents the numbered sequentially and monotonically
 * 
 * @author José Carlos <josecarlos@globtec.com.br>
 */
class Sequence
{
    const MAX_VALUE = 999;
    
    /**
     * @var Workspace
     */
    private $workspace;
    
    /**
     * @param Workspace $workspace
     */
    public function __construct(Workspace $workspace)
    {
        $this->workspace = $workspace;    
    }
    
    /**
     * Create sequence monotonically, numbers will not be reused
     * 
     * @throws DomainException
     * 
     * @return int The next value in a sequence
     */
    public function next() : int
    {
        $sequence = $this->workspace->count() + 1;
        
        if ($sequence > self::MAX_VALUE) {
            throw new DomainException('Next value exceeds the max value and cannot be used');
        }
        
        return $sequence;
    }
}