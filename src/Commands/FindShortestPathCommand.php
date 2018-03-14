<?php

namespace Otus\Commands;

use Otus\Algorithms\Dijkstra;
use Otus\Files\JsonFile;
use Otus\Graph\Edge;
use Otus\Graph\Graph;
use Otus\Graph\Node;
use Otus\Matrix\IncidenceMatrix;
use Otus\Matrix\Matrix;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FindShortestPathCommand extends Command
{
    /**
     * Configures the command
     */
    public function configure()
    {
        $this
            ->setName('path:find')
            ->setDescription('Finds the shortest path to all edges of the graph. The format of the response is "node" => "path length"')
            ->addArgument(
                'filepath',
                InputArgument::REQUIRED,
                'Path to the json file with the incidence matrix'
            );
    }

    /**
     * Executes when the command called
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        // Read file and render a valid graph
        try {
            $fileData = $this->readFile($input->getArgument('filepath'));

            if (empty($fileData)) {
                throw new \InvalidArgumentException("The json file can't be empty.");
            }

            $incidenceMatrix = (new IncidenceMatrix())->setRows($fileData);
            $incidenceMatrix->check();

            $graph = $this->renderGraph($incidenceMatrix);
        } catch (\InvalidArgumentException $e) {
            return $output->writeln("<error>{$e->getMessage()}</error>");
        }

        // Use Dijkstra algorithm for searching shortest path.
        $response = (new Dijkstra)->findShortestPaths($graph);

        // Writing output
        $output->writeln("<info>Shortest paths to the all nodes. Format: 'Node ID' => 'Path length'</info>");
        ksort($response);
        foreach ($response as $nodeId => $pathLength) {
            $nodeId++;
            $output->writeln("<info>{$nodeId} => {$pathLength}</info>");
        }
    }

    /**
     * Reads file from the given path
     *
     * @param string $filepath
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    protected function readFile(string $filepath)
    {
        $jsonFile = new JsonFile($filepath);

        if (!$jsonFile->exists()) {
            throw new \InvalidArgumentException("There is no file: {$jsonFile->getPath()}");
        }

        return $jsonFile->parse()->getContent();
    }

    /**
     * Renders graph from the incidence matrix
     *
     * @param Matrix $matrix
     *
     * @return Graph
     */
    protected function renderGraph(Matrix $matrix): Graph
    {
        $rowKeys = array_keys($matrix->getRows());
        $nodes = array_map(function ($rowKey) {
            return (new Node())->setId($rowKey);
        }, $rowKeys);

        $columns = $matrix->transpose();
        $columnKeys = array_keys($columns);
        $edges = array_map(function ($column, $key) {
            $edge = (new Edge())->setId($key);

            // Filter zero values.
            $nonZeroValues = array_filter($column, function ($value) {
                return $value !== 0;
            });

            // Fill edge properties.
            foreach ($nonZeroValues as $index => $nonZeroValue) {
                if ($nonZeroValue > 0) {
                    $edge->setStartNodeId($index)->setWeight($nonZeroValue);
                } else {
                    $edge->setDestinationNodeId($index);
                }
            }

            return $edge;
        }, $columns, $columnKeys);

        return (new Graph())
            ->setNodes($nodes)
            ->setEdges($edges);
    }
}