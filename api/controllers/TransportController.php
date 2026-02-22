<?php

class TransportController
{
    private TransportRepository $transportRepo;

    public function __construct(TransportRepository $transportRepo)
    {
        $this->transportRepo = $transportRepo;
    }

    public function index()
    {
        $transports = $this->transportRepo->findAll();
        echo json_encode($transports);
    }
}
