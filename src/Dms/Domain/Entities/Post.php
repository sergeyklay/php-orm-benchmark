<?php declare(strict_types = 1);

namespace OrmBench\Dms\Domain\Entities;

use Dms\Common\Structure\DateTime\DateTime;
use Dms\Common\Structure\Web\Html;
use Dms\Core\Exception\InvalidOperationException;
use Dms\Core\Model\EntityCollection;
use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;
use Dms\Core\Util\IClock;

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

    /**
     * @var DateTime
     */
    public $createdAt;

    /**
     * @var DateTime
     */
    public $updatedAt;

    /**
     * Post constructor
     *
     * @param string $title
     * @param Html $body
     * @param IClock $clock
     */
    public function __construct(
        string $title,
        Html $body,
        IClock $clock
    ) {
        parent::__construct();
        $this->title           = $title;
        $this->body            = $body;
        $this->createdAt       = new DateTime($clock->utcNow());
        $this->updatedAt       = new DateTime($clock->utcNow());
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

        $class->property($this->createdAt)->asObject(DateTime::class);

        $class->property($this->updatedAt)->asObject(DateTime::class);
    }
    
}
