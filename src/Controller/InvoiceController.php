<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\FormType\InvoiceFormType;
use App\FormType\InvoiceStatusFormType;
use App\Service\Contract\InvoiceServiceInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class InvoiceController
 *
 * @Rest\Route("/api")
 * @package App\Controller
 */
class InvoiceController extends AbstractFOSRestController
{
    /**
     * @Rest\Post("/invoices")
     *
     * @param Request                 $request
     * @param InvoiceServiceInterface $invoiceService
     *
     * @return Response
     */
    public function create(Request $request, InvoiceServiceInterface $invoiceService)
    {
        $form = $this->createForm(InvoiceFormType::class, new Invoice());
        $data = json_decode($request->getContent(),true);
        $form->submit($data);

        if (!$form->isSubmitted() && !$form->isValid()) {
            return $this->handleView($this->view($form->getErrors()));
        }

        return $this->handleView($this->view([
            'data' => $invoiceService->create($form->getData()),
            ],
            Response::HTTP_CREATED)
        );
    }

    /**
     * @Rest\Patch("/invoices/{id}")
     *
     * @param Invoice $invoice
     * @param Request $request
     * @param InvoiceServiceInterface $invoiceService
     *
     * @return Response
     */
    public function update(Invoice $invoice, Request $request, InvoiceServiceInterface $invoiceService)
    {
        $form = $this->createForm(InvoiceStatusFormType::class, $invoice, [
            'method' => 'PATCH',
        ]);

        $data = json_decode($request->getContent(),true);
        $form->submit($data);

        if (!$form->isSubmitted() && !$form->isValid()) {
            return $this->handleView($this->view($form->getErrors()));
        }

        return $this->handleView($this->view([
                'data' => $invoiceService->update($invoice),
            ],
            Response::HTTP_OK)
        );
    }
}
