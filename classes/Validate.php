<?php

class Validate {
	private $_passed	= false,
			$_errors	= array(),
			$_db		= null;

	public function __construct(){
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = array()) {
		foreach($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				
				$value = trim($source[$item]);
				$item = escape($item);


				if ($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				} else if (!empty($value)) {
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
							break;
						case 'max':
						if (strlen($value) > $rule_value) {
								$this->addError("{$item} can be a maximum of {$rule_value} characters.");
							}
							break;
						case 'matches':
								
								if ($value != $source[$rule_value]) {
									$this->addError("{$rule_value} must match {$item}");
								}

							break;

						case 'pnum':
							if(!Pnum::check($value)) {
							    $this->addError("{$item} is not a valid SSN.");
							}

						break;

						case 'spar':
							if(!Pnum::check($value)) {
							    $this->addError("{$item} is not a valid SSN.");
							    //SPAR CHECK NOT NEEDED! - LETS SAVE THE MONEY INSTEAD :)
							} else {
								//CONNECT AND CHECK SPAR ...

								//SPAR IS A SWEDISH SERVICE FROM THE GOVERMENT TO CHECK IF A PERSON EXISTS AND HAVE ENTERED ALL THE INFO CORRECTLY AGAINST THEIR DATABASE
							}

						break;

						case 'numeric':
						
							if (!is_numeric($value)) {
								$this->addError("{$item} can not only be numeric.");
							}
							
						break;

						case 'email':
							if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
	     						$this->addError("{$item} must be a valid email.");
	   						 }

						break;
						
						case 'notnumeric':
							
							if (is_numeric($value)){
								$this->addError("{$item} can only contain numbers.");
							}
						
						break;

						case 'activeuser':

								//Check if the user is active.
								//$check = User::active($value);
								if (1 != 2) {
									$this->addError("Account not activated.");
								}

						break;

						case 'unique':
								$check = $this->_db->get($rule_value, array($item, '=', $value));
								if ($check->count()) {
									$this->addError("{$item} already exists.");
								}


						break;
					}

				}

			}
		}

		if (empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;

	}

	private function addError($error){
		$this->_errors[] = $error;
	}

	public function errors() {
		return $this->_errors;
	}

	public function passed() {
		return $this->_passed;
	}



}