<?php 

	class BeeHives {
		public $queenBees;
		public $workerBees;
		public $droneBees;

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
			$randomIndex = array_rand($this->beesArr);
			$bee = $this->beesArr[$randomIndex];
			$bee->hit();
			echo PHP_EOL.$this->hitMessage($bee).PHP_EOL.PHP_EOL;
			//if beehive lifespan is <= 0 remove from array;
			if($bee->lifespan <= 0){
				echo $bee->name()." is dead".PHP_EOL.PHP_EOL;
				unset($this->beesArr[$randomIndex]);
			} 
		}

		function currentBeeHivesState(){
			echo "---------------------------------------------------------";
			echo PHP_EOL."QueenBeesLifeSpan: ".$this->queenBees->lifespan.PHP_EOL
			."WorkerBeesLifeSpan: ".$this->workerBees->lifespan.PHP_EOL
			."DroneBeesLifeSpan: ".$this->droneBees->lifespan.PHP_EOL.PHP_EOL;
		}

		function hitMessage($bee){
			return "Direct Hit. You took ".$bee->hitEffect." hit points from a ".$bee->name();
		}

		function remainingHits(){
			return (($this->queenBees->lifespan/$this->queenBees->numOfBees) + ($this->workerBees->lifespan/$this->workerBees->numOfBees) + ($this->droneBees->lifespan/$this->droneBees->numOfBees)).
			" hits were needed to destroy the hive";
		}

	}

	class QueenBee {

		public $numOfBees = 1;
		public $hitEffect = 8;
		public $lifespan = 100;

		function __construct(){
			$this->lifespan*=$this->numOfBees;
		}

		function hit(){
			$this->lifespan-=$this->hitEffect;
		}

		function name(){
			return 'Queen bee';
		}
	}

	class WorkerBee {
		public $numOfBees = 5;
		public $hitEffect = 10;
		public $lifespan = 75;

		function __construct(){
			$this->lifespan*=$this->numOfBees;
		}

		function hit(){
			$this->lifespan-=$this->hitEffect;
		}

		function name(){
			return 'Worker bee';
		}
	}

	class DroneBee{
		public $numOfBees = 8;
		public $hitEffect = 12;
		public $lifespan = 50;

		function __construct(){
			$this->lifespan*=$this->numOfBees;
		}

		function hit(){
			$this->lifespan-=$this->hitEffect; 
		}

		function name(){
			return 'Drone bee';
		}
	}
	//init
	$b = new BeeHives(new QueenBee(), new WorkerBee, new DroneBee);

	//run game loop 
	//while queen bee is alive keep running
	while($b->queenBees->lifespan > 0){
		$b->currentBeeHivesState();
		echo 'Enter \'hit\' to attack the bee hives!'.PHP_EOL.PHP_EOL;
		$handle = fopen ("php://stdin","r");
		$line = fgets($handle);
		if(trim(strtolower($line)) == 'hit'){
			$b->hit();
		}
	}

	echo "Game Over: ".$b->remaininghits();
?>