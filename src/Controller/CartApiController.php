<?php

namespace App\Controller;

use App\Currency\CurrencyFormatter;
use App\Discount\DiscountChecker;
use App\Tax\TaxCalculator;
use App\Validator\ProductValidator;
use App\Validator\CurrencyValidator;
use App\Fixture\ProductFixture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Cart Controller
 * @Route("/api/cart", name="api_cart_")
 * 
 */
class CartApiController extends AbstractController
{
    /**
     * @Route("/calculate_bill", name="calculate_bill", methods={"POST"})
     */
    public function calculateBill(Request $request): Response
    {
        $currency = $request->request->get('currency') ?? $this->getParameter('app.defaultCurrency');
        $products = $request->request->get('products') ?? [];

        $productValidator = new ProductValidator($products);
        if (!$productValidator->validate()) {
            return $this->json("incorrect product codes", 400);
        }
        $currencyValidator = new CurrencyValidator($currency);
        if (!$currencyValidator->validate()) {
            return $this->json("incorrect currency codes", 400);
        }

        $subtotal = $this->getSubTotal($products);

        $taxes = (new TaxCalculator($subtotal))->calculateTaxes();

        $discountsChecker = new DiscountChecker($products);
        $discounts = $discountsChecker->applyDiscounts();
        $totalDiscount = $discountsChecker->getTotalDiscount();

        $total = $subtotal + $taxes - $totalDiscount;

        $currencyFormatter = new CurrencyFormatter($currency);

        return $this->render('cart/bill.html.twig', [
            'subtotal' => $currencyFormatter->format($subtotal),
            'taxes' => $currencyFormatter->format($taxes),
            'totalDiscount' => $totalDiscount,
            'discounts' => $currencyFormatter->formatArray($discounts),
            'total' => $currencyFormatter->format($total),
        ]);
    }

    /**
     * calculate subtotal
     */
    private function getSubTotal($products)
    {
        $subtotal = 0;
        $allProducts = (new ProductFixture)->loadData();
        foreach ($products as $productCode) {
            $subtotal += $allProducts[$productCode];
        }

        return $subtotal;
    }
}
