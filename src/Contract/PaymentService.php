<?php

namespace Nekoding\LaravelSoftbank\Contract;

interface PaymentService
{

    /**
     * createTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public function createTransaction(Payload $payload): Response;

    
    /**
     * confirmTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public function confirmTransaction(Payload $payload): Response;

        
    /**
     * marksTransactionSales
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public function marksTransactionSales(Payload $payload): Response;
    
    /**
     * refundTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public function refundTransaction(Payload $payload): Response;
}
