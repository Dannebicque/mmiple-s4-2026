<?php

namespace App\Services;

use App\Repository\EditeurRepository;

class EditeurService
{
    public function __construct(private EditeurRepository $editeurRepository)
    {
    }

    /*
     * OU
     * private EditeurRepository $editeurRepository;
     *
     * public function __construct(EditeurRepository $editeurRepository)
        {
            $this->editeurRepository = $editeurRepository;
        }
     */

    public function countEditeurs(): int
    {
        return $this->editeurRepository->count([]);
    }
}
