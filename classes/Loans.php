<?php 
class Loans {
	
	public function Loan($to, $amount, $toname = null) {
		if ($to === 0){
			
			//Guest -- $toname = Inputed name.
		} else {
			//Non Guest
		}
	}
	
	public function Totalpay($id){
		//Calculate total left to pay.
		
		
		return $topay;
	}
	
	public function income($id){
		
		return 1;
	}
	
	public function dashboard($id){
		
		$dashboard['topay'] = $this->Totalpaid($id);
		$dashboard['getpaid'] = $this->income($id);
		
		
		return $dashboard;
	}
	
}