<?php

namespace App\Tests;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\ArticleService;
use phpDocumentor\Reflection\Types\This;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use function PHPUnit\Framework\once;

class ArticleServiceTest extends TestCase
{

    private ArticleRepository $articleRepository;
    private LoggerInterface $logger;
    protected function setUp(): void
    {
        $this->articleRepository = $this->createMock(ArticleRepository::class);
        $this->logger = $this->createMock(LoggerInterface::class);


    }

    public function testSomething(): void
    {
        $service = new ArticleService(
            $this->articleRepository,
            $this->logger,
        );

        $this->articleRepository->expects($this->once())->method('getRecentArticles')
            ->with(3)
            ->willReturn([new Article(), new Article(), new Article()]);

        $this->logger->expects($this->once())->method('info');

        $article = $service->getRecentArticles(3);

        $this->assertTrue(count($article) === 3);
    }
}