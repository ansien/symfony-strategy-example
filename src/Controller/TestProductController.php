<?php

namespace App\Controller;

use App\Entity\TestProduct;
use App\Form\TestProductType;
use App\PricingStrategy\PricingStrategyContext;
use App\Repository\TestProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test-product")
 */
class TestProductController extends AbstractController
{
    /**
     * @Route("/", name="test_product_index", methods="GET")
     *
     * @param TestProductRepository $testProductRepository
     * @param PricingStrategyContext $pricingStrategyContext
     * @return Response
     */
    public function index(TestProductRepository $testProductRepository, PricingStrategyContext $pricingStrategyContext): Response
    {
        $testProducts = $testProductRepository->findAll();
        $discountedPrices = [];

        foreach($testProducts as $testProduct) {
            $discountedPrices[$testProduct->getId()] = $pricingStrategyContext->getPrice($testProduct->getPrice());
        }

        return $this->render('test_product/index.html.twig', [
            'test_products' => $testProducts,
            'discounted_prices' => $discountedPrices
        ]);
    }

    /**
     * @Route("/new", name="test_product_new", methods="GET|POST")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $testProduct = new TestProduct();
        $form = $this->createForm(TestProductType::class, $testProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($testProduct);
            $em->flush();

            return $this->redirectToRoute('test_product_index');
        }

        return $this->render('test_product/new.html.twig', [
            'test_product' => $testProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_product_show", methods="GET")
     *
     * @param TestProduct $testProduct
     * @return Response
     */
    public function show(TestProduct $testProduct): Response
    {
        return $this->render('test_product/show.html.twig', ['test_product' => $testProduct]);
    }

    /**
     * @Route("/{id}/edit", name="test_product_edit", methods="GET|POST")
     *
     * @param Request $request
     * @param TestProduct $testProduct
     * @return Response
     */
    public function edit(Request $request, TestProduct $testProduct): Response
    {
        $form = $this->createForm(TestProductType::class, $testProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test_product_edit', ['id' => $testProduct->getId()]);
        }

        return $this->render('test_product/edit.html.twig', [
            'test_product' => $testProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_product_delete", methods="DELETE")
     *
     * @param Request $request
     * @param TestProduct $testProduct
     * @return Response
     */
    public function delete(Request $request, TestProduct $testProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testProduct->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($testProduct);
            $em->flush();
        }

        return $this->redirectToRoute('test_product_index');
    }
}
