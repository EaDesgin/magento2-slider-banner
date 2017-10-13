<?php

namespace Eadesigndev\Slider\Api\Data;

interface SliderInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SLIDER_ID       = 'slider_id';
    const TITLE         = 'title';
    const CONTENT_TYPE       = 'content_type';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';
    const IMAGE_URL     = 'image_url';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();


    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContentType();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();



    /**
     * Set ID
     *
     * @param int $id
     * @return \Eadesigndev\Slider\Api\Data\SliderInterface
     */
    public function setId($id);


    /**
     * Set title
     *
     * @param string $title
     * @return \Eadesigndev\Slider\Api\Data\SliderInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $contentType
     * @return \Eadesigndev\Slider\Api\Data\SliderInterface
     */
    public function setContentType($contentType);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \Eadesigndev\Slider\Api\Data\SliderInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \Eadesigndev\Slider\Api\Data\SliderInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \Eadesigndev\Slider\Api\Data\SliderInterface
     */
    public function setIsActive($isActive);


}