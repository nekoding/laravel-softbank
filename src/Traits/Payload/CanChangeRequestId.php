<?php

namespace Nekoding\LaravelSoftbank\Traits\Payload;

trait CanChangeRequestId
{

    protected $requestId;

    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;

        return $this;
    }

}