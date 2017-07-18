<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Service;

use Srider\Model\PostInterface;

interface PostServiceInterface
{          
    /**
     * Should return a set of all observation posts that we can iterate over. Single entries of the array are supposed to be
     * implementing \Srider\Model\PostInterface
     *
     * @return array|PostInterface[]
     */
    public function findAllPosts();

    /**
     * Should return a single Srider post
     *
     * @param  int $id Identifier of the Post that should be returned
     * @return PostInterface
     */
    public function findPost($id);

    public function savePost(PostInterface $blog);
}