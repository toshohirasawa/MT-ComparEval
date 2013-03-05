<?php

class Tasks {

	private $db;

	public function __construct( Nette\Database\Connection $db ) {
		$this->db = $db;
	}

	public function getTasks( $experimentId ) {
		return $this->db->table( 'tasks' )
			->where( 'experiments_id', $experimentId );
	}

	public function saveTask( $data ) {
		$row = $this->db->table( 'tasks' )->insert( $data );

		return $row->getPrimary( TRUE );
	}

	public function addSentences( $taskId, $sentences, $metrics ) {
		foreach( $sentences as $key => $sentence ) {
			$data = array(
				'sentences_id' => $sentence['experiment']['id'],
				'tasks_id' => $taskId,
				'text' => $sentence['translation']
			);

			$translationId = $this->db->table( 'translations' )->insert( $data );
			
			foreach( $metrics as $metric => $values ) {
				$data = array(
					'translations_id' => $translationId,
					'metrics_id' => $this->db->table( 'metrics' )->where( 'name', $metric )->fetch()->id,
					'score' => $values[ $key ]
				);
				$this->db->table( 'translations_metrics' )->insert( $data );			
			}
		}
	}

	public function addMetric( $taskId, $metric, $value ) {
		$data = array(
			'tasks_id' => $taskId,
			'metrics_id' => $this->db->table( 'metrics' )->where( 'name', $metric )->fetch()->id,
			'score' => $value
		);

		$this->db->table( 'tasks_metrics' )->insert( $data );
	}

	public function deleteTaskByName( $experimentId, $name ) {
		$this->db->table( 'tasks' )
			->where( 'experiments_id', $experimentId )
			->where( 'url_key', $name )
			->delete();
	}


}