<?php
namespace Entrata\DBCache\Cache;
interface IDataset
{
    /**
     * Get the unique key for this dataset.
     *
     * @return string
     */
    public function getKey(): string;

    /**
     * Load data from the dataset.
     *
     * @return mixed
     */
    public function load();

    /**
     * Check if the dataset needs to be refreshed.
     *
     * @return bool
     */
    public function needsRefresh($data): bool;

    /**
     * Refresh the dataset.
     *
     * @return void
     */
    public function refresh();

    /**
     * Map the data to the dataset.
     * @param mixed $data
     * @return void
     */
    public function assignData($data);
}
