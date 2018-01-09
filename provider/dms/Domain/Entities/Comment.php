<?php declare(strict_types = 1);

namespace OrmBench\Dms\Domain\Entities;

use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;

class Comment extends Entity
{
    const POST = 'post';
    const BODY = 'body';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';    

    /**
     * @var Post
     */
    public $post;   

    /**
     * @var string
     */
    public $body;

    public $createdAt;

    public $updatedAt;

    /**
     * Comment
     *
     * @param Post $post
     * @param string $body
     * @param IClock $clock
     */
    public function __construct(Post $post, string $body)
    {
        parent::__construct();
        $this->post      = $post;
        $this->body      = $body;
        $this->createdAt = time();
        $this->updatedAt = time();
    }


    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->post)->asObject(Post::class);

        $class->property($this->body)->asString();

        $class->property($this->createdAt)->asInt();
        
        $class->property($this->updatedAt)->asInt();
    }
    
}
