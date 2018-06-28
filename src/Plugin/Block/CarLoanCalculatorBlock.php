<?php
/**
 * Created by PhpStorm.
 * User: vetaly
 * Date: 6/26/18
 * Time: 5:55 PM
 */

namespace Drupal\loan_calculator\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\loan_calculator\Form\CarLoanCalculatorForm;

/**
 * Provides a car loan calculator block.
 *
 * @Block(
 *  id = "loan_calculator_car_loan_block",
 *  admin_label = @Translation("Financial Calculator")
 * )
 */
class CarLoanCalculatorBlock extends BlockBase
{

    /**
     * Builds and returns the renderable array for this block plugin.
     *
     * If a block should not be rendered because it has no content, then this
     * method must also ensure to return no content: it must then only return an
     * empty array, or an empty array with #cache set (with cacheability metadata
     * indicating the circumstances for it being empty).
     *
     * @return array
     *   A renderable array representing the content of the block.
     *
     * @see \Drupal\block\BlockViewBuilder
     */
    public function build()
    {

        $node_price = 0;

        $node = \Drupal::routeMatch()->getParameter('node');
        if ($node instanceof \Drupal\node\NodeInterface) {
            // You can get nid and anything else you need from the node object.
            try{
                $node_price = $node->get('field_price')->getValue()[0]['value'];
            }
            catch (\Exception $e){
                $node_price = 0;
            }

        }

        $defaultForm = new CarLoanCalculatorForm();
        $form = \Drupal::formBuilder()->getForm($defaultForm);

        $form['loan_amount']['#value'] = $node_price;
        return $form;

    }
}