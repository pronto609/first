<?php
declare(strict_types=1);
namespace Mage\Blog\ViewModel;;

use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
/**
 * Class Block
 */
class Blog implements ArgumentInterface
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer){
        $this->serializer = $serializer;
    }


    /**
     * @return string
     */
    public function getPosts(): string
    {
        return $this->serializer->serialize([
            [
                "id" => 1,
                "title" => "First post",
                "url" => "http =>//magento.test/first-post",
                "published_data" => "2021-12-24",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet blanditiis ea libero minima odio perspiciatis saepe? A commodi ducimus et illum, impedit maxime mollitia qui quisquam, repudiandae saepe voluptas?",
                "author" => "Author1"
            ],
            [
                "id" => 2,
                "title" => "Second post",
                "url" => "http =>//magento.test/second-post",
                "published_data" => "2021-09-7",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet blanditiis ea libero minima odio perspiciatis saepe? A commodi ducimus et illum, impedit maxime mollitia qui quisquam, repudiandae saepe voluptas?",
                "author" => "Author2"

            ],
            [
                "id" => 3,
                "title" => "Third post",
                "url" => "http =>//magento.test/third-post",
                "published_data" => "2021-10-4",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet blanditiis ea libero minima odio perspiciatis saepe? A commodi ducimus et illum, impedit maxime mollitia qui quisquam, repudiandae saepe voluptas?",
                "author" => "Author3"
            ],
            [
                "id" => 4,
                "title" => "Fourth post",
                "url" => "http =>//magento.test/fourth-post",
                "published_data" => "2021-10-11",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet blanditiis ea libero minima odio perspiciatis saepe? A commodi ducimus et illum, impedit maxime mollitia qui quisquam, repudiandae saepe voluptas?",
                "author" => "Author4"
            ]
        ]);
    }
}
