<?php declare(strict_types = 1);

namespace OrmBench\Dms\Domain\Entities;

use Dms\Common\Structure\Web\Html;
use Dms\Core\Model\EntityCollection;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;

class Post extends Entity
{
    const TITLE = 'title';
    const BODY = 'body';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const COMMENTS = 'comments';

    /**
     * @var string
     */
    public $title;

    /**
     * @var Html
     */
    public $body;

    /**
     * @var EntityCollection|Comment
     */
    public $comments;

    public $createdAt;

    public $updatedAt;

    /**
     * Post constructor
     *
     * @param string $title
     * @param Html $body
     */
    public function __construct(string $title, Html $body) 
    {
        parent::__construct();
        $this->title           = $title;
        $this->body            = $body;
        $this->createdAt       = time();
        $this->updatedAt       = time();
        $this->comments        = Comment::collection();
    }


    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->title)->asString();

        $class->property($this->body)->asObject(Html::class);

        $class->property($this->comments)->asType(Comment::collectionType());

        $class->property($this->createdAt)->asInt();
        
        $class->property($this->updatedAt)->asInt();
    }
    
}
