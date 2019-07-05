<?php

namespace App\Controller;

use App\Kernel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JobsApiController
{
    /**
     * @Route("/jobs")
     */
    public function number()
    {
        $json = file_get_contents(Kernel::getProjectDir().'/var/jobs/results.json');

        return new Response($json);
    }
}