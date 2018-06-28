/**
 * @file
 *
 * Implement a loan calculator.
 *
 */
(function ($) {

    // Make sure our objects are defined.
    Drupal.CarLoanCalculator = Drupal.CarLoanCalculator || {};

    /**
     * Calculation after a click
     */
    Drupal.CarLoanCalculator.cmd_Calc_Click = function(form) {
        let loan_amount = parseFloat(form.loan_amount.value);
        let loan_tare = parseFloat(form.loan_rate.value);
        let down_payment = parseFloat(form.down_payment.value);
        let loan_term = parseInt(form.loan_term.value);

        let results = [];


        if ( loan_amount === 0 ) {
            form.calculate_result.value = Drupal.t("Loan Amount can't be 0!");
            form.loan_amount.focus();
        }
        else if (loan_tare === 0) {
            form.calculate_result.value = Drupal.t("The Interest Rate can't be 0!");
            form.loan_tare.focus();
        }
        else if (loan_term === 0 ) {
            form.calculate_result.value = Drupal.t("Please select your loan term!");
            form.loan_term.focus();
        }
        else if(down_payment >0 && down_payment > loan_amount){
            form.calculate_result.value = Drupal.t("Down Payment cannot be greater than the loan amount!");
            form.down_payment.focus();
        }
        else {
            results = Drupal.CarLoanCalculator.loanCalculation(loan_amount- down_payment, loan_tare, loan_term);
            form.calculate_result.value = results['calculation'].toFixed(2);
        }


        // form.calculate_result.value = 'A lot dude!';

        $("#loan-calculator-car-loan-form #edit-calculate-result").val(form.calculate_result.value);

    };

    Drupal.CarLoanCalculator.loanCalculation = function(loanAmount, loanRate, loanTerm) {

        let monthly_payment = (loanRate / 1200 * loanAmount) / (1 - Math.pow(1+(loanRate / 1200),-(loanTerm)));
        results = [];
        results['calculation'] = monthly_payment;
        return results;
    };

    Drupal.behaviors.loanCalculator = {
        attach: function (context, settings) {
            $("#loan-calculator-car-loan-form button", context).click(function(event) {
                Drupal.CarLoanCalculator.cmd_Calc_Click(this.form);
                return false;
            });
        }
    };
})(jQuery);