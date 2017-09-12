<?php
/**
 * Created by PhpStorm.
 * User: adiaz
 * Date: 2017-09-11
 * Time: 12:16 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Service\Products;
use AppBundle\Form\Type\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function listAction(){
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        return $this->render(':product:index.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/newProduct", name="newProduct")
     */
    public function newProductAction(Request $request, Products $products){
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $product = $form->getData();
            $products->save($product);            
            $products->sendMail($product);
            return $this->RedirectToRoute('list');
        }
        return $this->render(':product:newProduct.html.twig', ['form' => $form->createView()]);

    }
}