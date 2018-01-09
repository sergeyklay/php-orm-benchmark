<?php

namespace OrmBench\Doctrine\Models;

/**
 * @Entity @Table(name="comments")
 **/
class Comments
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer")
     * 
     */
    protected $post_id;
    
    /**
     * @Column(type="text", length=65535)
     */
    protected $body;
    
    /**
     * @Column(type="integer")
     */
    protected $created_at;
    
    /**
     * @Column(type="integer")
     */
    protected $updated_at;
    
    /**
     * @ManyToOne(targetEntity="Posts", inversedBy="comments")
     */
    protected $post;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set postId
     *
     * @param integer $postId
     *
     * @return Comments
     */
    public function setPostId($postId)
    {
        $this->post_id = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return integer
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Comments
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdAt
     *
     * @param integer $createdAt
     *
     * @return Comments
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param integer $updatedAt
     *
     * @return Comments
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return integer
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set post
     *
     * @param Posts $post
     *
     * @return Comments
     */
    public function setPost(Posts $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return Posts
     */
    public function getPost()
    {
        return $this->post;
    }
}
