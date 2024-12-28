<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\EpisodeModel;
use CodeIgniter\CLI\BaseCommand;

class EpisodesComputeDownloads extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Episodes';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'episodes:compute-downloads';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = "Calculates all episodes downloads and stores results in episodes' downloads_count field.";

    /**
     * Actually execute a command.
     */
    public function run(array $params): void
    {
        $episodesModel = new EpisodeModel();
        $query = $episodesModel->builder()
            ->select('episodes.id as id, IFNULL(SUM(ape.hits),0) as downloads_count')
            ->join('analytics_podcasts_by_episode ape', 'episodes.id=ape.episode_id', 'left')
            ->groupBy('episodes.id');

        $episodeModel2 = new EpisodeModel();
        $episodeModel2->builder()
            ->setQueryAsData($query)
            ->onConstraint('id')
            ->updateBatch();
    }
}
