<?php declare(strict_types = 1);

namespace OrmBench\Dms\Domain\Entities;

use Dms\Common\Structure\DateTime\DateTime;
use Dms\Common\Structure\Web\Html;
use Dms\Core\Exception\InvalidOperationException;
use Dms\Core\Model\EntityCollection;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Util\IClock;

class Comment extends Entity
{
    const post = 'post';
    const BODY = 'body';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';    

    /**
     * @var Post
     */
    public $post;   

    /**
     * @var Html
     */
    public $body;

    /**
     * @var DateTime
     */
    public $createdAt;

    /**
     * @var DateTime
     */
    public $updatedAt;

    /**
     * Comment
     *
     * @param Post $post
     * @param string $body
     * @param IClock $clock
     */
    public function __construct(Post $post, string $body, IClock $clock)
    {
        parent::__construct();
        $this->post      = $post;
        $this->body      = $body;
        $this->createdAt = new DateTime($clock->utcNow());
        $this->updatedAt = new DateTime($clock->utcNow());
    }


    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->post)->asObject(Post::class);

        $class->property($this->body)->asObject(Html::class);

        $class->property($this->createdAt)->asObject(DateTime::class);

        $class->property($this->updatedAt)->asObject(DateTime::class);
    }
    
}
