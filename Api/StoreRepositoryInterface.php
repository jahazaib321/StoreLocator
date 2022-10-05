<?php
namespace Mage4\StoreLocator\Api;

use Mage4\StoreLocator\Api\Data\StoreInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface StoreRepositoryInterface
 *
 * @api
 */
interface StoreRepositoryInterface
{
    /**
     * Create or update a Store.
     *
     * @param StoreInterface $page
     * @return StoreInterface
     */
    public function save(StoreInterface $page);

    /**
     * Get a Store by Id
     *
     * @param int $id
     * @return StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If Store with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve Stores which match a specified criteria.
     *
     * @param SearchCriteriaInterface $criteria
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete a Store
     *
     * @param StoreInterface $page
     * @return StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If Store with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(StoreInterface $page);

    /**
     * Delete a Store by Id
     *
     * @param int $id
     * @return StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If customer with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}

