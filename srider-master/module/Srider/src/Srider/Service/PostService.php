<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Service;
use Srider\Model\Post;
use Srider\Mapper\PostMapperInterface;

class PostService implements PostServiceInterface
{
    /**
      * @var \Srider\Mapper\PostMapperInterface
      */
    protected $postMapper;
    
    public function __construct(PostMapperInterface $postMapper)
    {
       $this->postMapper = $postMapper;
    }
     
    /**
     * {@inheritDoc}
     */
    public function findAllPosts()
    {
        return $this->postMapper->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findPost($id)
    {
        return $this->postMapper->find($id);
    }
    
    /**
      * {@inheritDoc}
      */
     public function savePost(PostInterface $post)
     {
         return $this->postMapper->save($post);
     }
}
