<?php
namespace App\Http\controllers\Sancofa\service;
use Illuminate\Support\Carbon;
use Andegna\DateTime;
use Andegna\DateTimeFactory;
use App\Sancofa\ListOfMonthlyPayment;

/**
 * 
 */
class MonthlyPaymentService
{
	
	public function calculate_TotalMonthlyPayment_Of_Specfic_Month($year,$month,$amount)
	{   
		$total = 0;
        if ($month == 'september') {
        	$total = (ListOfMonthlyPayment::where('september',true)->count())*$amount;
        }elseif ($month == 'october') {
        	$total = (ListOfMonthlyPayment::where('october',true)->count())*$amount;
        }elseif ($month == 'november') {
        	$total = (ListOfMonthlyPayment::where('november',true)->count())*$amount;
        	
        }elseif ($month == 'december') {
        	$total = (ListOfMonthlyPayment::where('december',true)->count())*$amount;
        	
        }elseif ($month == 'january') {
        	$total = (ListOfMonthlyPayment::where('january',true)->count())*$amount;
        	
        }elseif ($month == 'february') {
        	$total = (ListOfMonthlyPayment::where('february',true)->count())*$amount;
        	
        }elseif ($month == 'march') {
        	$total = (ListOfMonthlyPayment::where('march',true)->count())*$amount;
        	
        }elseif ($month == 'april') {
        	$total = (ListOfMonthlyPayment::where('april',true)->count())*$amount;
        	
        }elseif ($month == 'may') {
        	$total = (ListOfMonthlyPayment::where('may',true)->count())*$amount;
        	
        }elseif ($month == 'june') {
        	$total = (ListOfMonthlyPayment::where('june',true)->count())*$amount;
        	
        }elseif ($month == 'july') {
        	$total = (ListOfMonthlyPayment::where('july',true)->count())*$amount;

        }elseif ($month == 'august') {
        	$total = (ListOfMonthlyPayment::where('august',true)->count())*$amount;
        	
        }

        return $total;
	}


	public function calculate_Total_Monthly_Payment($year,$amount)
	{
	   $september_payment = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'september',$amount);
	   $october_payment   = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'october',$amount);
	   $november_payment  =  $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'november',$amount);
	   $december_payment  = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'december',$amount);
	   $january_payment   = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'january',$amount);
	   $february_payment  = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'february',$amount);
	   $march_payment     = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'march',$amount);
	   $april_payment     = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'april',$amount);
	   $may_payment       = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'may',$amount);
	   $june_payment      = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'june',$amount);
	   $july_payment      = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'july',$amount);
       $august_paymemt    = $this->calculate_TotalMonthlyPayment_Of_Specfic_Month($year,'august',$amount);
	   $total_monthly_payment = ($september_payment+$october_payment+$november_payment+$december_payment+$january_payment+$february_payment+$march_payment+$april_payment+$may_payment+$june_payment+$july_payment+$august_paymemt);

	   return $total_monthly_payment;
	}
}
?>