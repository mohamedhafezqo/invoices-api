<?php

namespace App\Controller;

use App\Entity\Company;
use App\FormType\CompanyFormType;
use App\Service\Contract\CompanyServiceInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class CompanyController
 *
 * @Rest\Route("/api")
 * @package App\Controller
 */
class CompanyController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/companies")
     *
     * @param Request $request
     * @param CompanyServiceInterface $companyService
     *
     * @return Response
     */
    public function create(Request $request, CompanyServiceInterface $companyService)
    {
        $form = $this->createForm(CompanyFormType::class, new Company());
        $data = json_decode($request->getContent(),true);
        $form->submit($data);

        if (!$form->isSubmitted() && !$form->isValid()) {
            return $this->handleView($this->view($form->getErrors()));
        }

        return $this->handleView($this->view([
            'data' => $companyService->create($form->getData()),
            ],
            Response::HTTP_CREATED)
        );
    }
}
