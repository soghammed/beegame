<?php 

	class BeeHives {
		private $queenBees;
		private $workerBees;
		private $droneBees;

		public function __construct(QueenBee $queenBees, WorkerBee $workerBees, DroneBee $droneBees){
			$this->queenBees = $queenBees;
			$this->workerBees = $workerBees;
			$this->droneBees = $droneBees;
			$this->beesArr = array(
				$queenBees,
				$workerBees,
				$droneBees
			);

		}

		function hit(){
			//random selection of queen worker or drone bee
			$this->beesArr[array_rand($this->beesArr)]->hit();
			return $this;
		}

		function remainingHits(){
			return $this->queenBees->lifespan + $this->workerBees->lifespan + $this->droneBees->lifespan;
		}
	}

	class QueenBee {

		private $numOfBees = 1;
		public $lifespan = 100;

		function hit(){
			$this->lifespan-=8;
		}

	}

	class WorkerBee {
		private $numOfBees = 5;
		public $lifespan = 75;

		function hit(){
			$this->lifespan-=10;
		}
	}

	class DroneBee{
		private $numOfBees = 8;
		public $lifespan = 50;

		function hit(){
			$this->lifespan-=12; 
		}
	}
	//run game loop 
	//while queen bee is alive keep running |
	$b = new BeeHives(new QueenBee(), new WorkerBee, new DroneBee);
	var_dump($b->hit());
	var_dump($b->remainingHits());
	// var_dump($b);
	// $handle = fopen ("php://stdin","r");
	// $line = fgets($handle);
	// if(trim($line) != 'yes' || $gameover){
	//     echo "ABORTING!\n";
	//     exit;
	// }else{
	// 	echo 'coool';
	// }
?>