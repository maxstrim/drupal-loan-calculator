<?php
/**
 * Created by PhpStorm.
 * User: vetaly
 * Date: 6/26/18
 * Time: 5:59 PM
 */

namespace Drupal\loan_calculator\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CarLoanCalculatorForm extends FormBase
{

    /**
     * Returns a unique string identifying the form.
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId()
    {
        return "loan_calculator_car_loan_form";
    }

    /**
     * Form constructor.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   The form structure.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['loan_amount'] = [
                '#type' => 'textfield',
                '#title' => $this->t('Principle or Sum [P]'),
                '#size' => 15,
                '#required' => TRUE,
                '#maxlength' => 64,
                '#description' => $this->t('Loan amount'),
        ];
        $form['loan_rate'] = [
            '#type' => 'number',
            '#title' => $this->t('Interest rate (%)'),
            '#step' => .1,
            '#required' => TRUE,
            '#min' => 0,
            '#max' => 100,
            '#size' => 15,
        ];
        $form['loan_term'] = [
            '#type' => 'radios',
            '#title' => $this->t('Loan Period (Years)'),
            '#size' => 15,
            '#required' => TRUE,
            '#default_value' => 60,
            '#options' => [
                '36'=> '36 Months',
                '48'=> '48 Months',
                '60'=> '60 Months',
            ],
        ];
        $form['down_payment'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Down Payment'),
            '#size' => 15,
            '#required' => FALSE,
            '#default_value' =>'0',
            '#maxlength' => 64,
        ];

        $form['#executes_submit_callback'] = FALSE;
        $form['calculate'] = [
            '#type' => 'button',
            '#value' => $this->t('Calculate'),
        ];

        $form['calculate_result'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Monthly Payments'),
            '#size' => 15,
            '#maxlength' => 64,
            '#attributes' => ['readonly' => ['readonly']],
        ];

        // Attach js and required js libraries.
        $form['#attached']['library'][] = 'system/jquery';
        $form['#attached']['library'][] = 'system/drupal';
        $form['#attached']['library'][] = 'loan_calculator/loan_calculator_js';
        return $form;
    }

    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}