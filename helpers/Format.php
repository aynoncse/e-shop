<?php
	class Format{
		public function formatDate($date){
			return date('F j, Y, g:i a',strtotime($date));
		}
		public function title(){
			$title = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($title, '.php');
			$title = str_replace('_', ' ', $title);
			if ($title == 'index') {
				$title = 'Home';
				return ucwords($title);
			}else{
				return ucwords($title);
			}
		}
		public function validate($data){
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			
			return $data;
		}
		public function textShorten($text, $limit = 500){
			$text = $text. " ";
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text;
			return $text;
		}

		function calculateAge ($year,$month,$day){
			$currentYear = Date('Y');
			$currentMonth = Date('m'); 
			$currentDate = Date('d'); 

			if($currentDate>$day) {
				$day = $currentDate - $day;
			}else{
				$currentDate +=30;
				$day = $currentDate - $day;
				$currentMonth --;
			}

			if($currentMonth>$day) {
				$day = $currentDate - $month;
			}else{
				$currentMonth +=12;
				$month = $currentMonth - $month;
				$currentYear --;
			}

			$year = $currentYear - $year;

			if($day>=30){
				$day-=30;
				$month++;
			}
			if ($month>=12){
				$month -=12;
				$year ++; 
			}

			return $year. " Years ". $month. " Months " . $day . " Days";
		}

	}
?>