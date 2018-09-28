<?php

namespace Samerior\MobileMoney\Mpesa\Commands;

use Illuminate\Console\Command;
use Samerior\MobileMoney\Mpesa\Repositories\MpesaApps;

/**
 * Class AddApp
 * @package Samerior\MobileMoney\Mpesa\Commands
 */
class AddApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpesa:add_app';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new MPESA app';
    /**
     * @var MpesaApps
     */
    private $repository;

    public function __construct(MpesaApps $mpesaApp)
    {
        parent::__construct();
        $this->repository = $mpesaApp;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->repository->addNewApp($this);
    }
}