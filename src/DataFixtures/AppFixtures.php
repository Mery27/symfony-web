<?php

namespace App\DataFixtures;

use App\Entity\Seo;
use App\Entity\Page;
use App\Entity\OGTags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use joshtronic\LoremIpsum;

class AppFixtures extends Fixture
{

    // public function __construct(
    //     private LoremIpsum $lorem,
    // ){
    // }

    public function load(ObjectManager $manager): void
    {
        $lorem = new LoremIpsum();

        for ($i = 1; $i < 20; $i++) {

            $page = new Page();
            $seo = new Seo();
            $ogTags = new OGTags();

            $page->setTitle("Page " . (string) $i);
            $page->setUrl("page-" . (string) $i);
            $page->setShortBody($lorem->paragraph('p'));
            $page->setBody($lorem->paragraphs(5, 'p'));

            $date = new \DateTime('now');
            $date->modify("+{$i} hour");
            $date = new \DateTimeImmutable($date->format('Y-m-d H:i:s'));
            $page->setCreatedAt($date);

            $seo->setTitle('Seo page' . (string) $i);
            $seo->setDescription($this->trimParagraph(150));
            $seo->setKeywords('symfony, locahost, development php');
            $seo->setAuthor('localhost');
            $seo->setRobots('noidex, nofollow');
            $seo->setHideInSitemap(true);
            
            $ogTags->setTitle('OG - page ' . (string) $i);
            $ogTags->setDescription($this->trimParagraph(200));
            $ogTags->setType('article');
            $ogTags->setUrl("page-" . (string) $i);
            $ogTags->setLocale('cs_CZ');
            $ogTags->setSiteName('Symfony');
            $ogTags->setImage('https://picsum.photos/id/684/600/400');
            
            $page->setSeo($seo);
            $page->setOgTags($ogTags);
            $page->setIsPublished(true);

            $manager->persist($seo);
            $manager->persist($ogTags);
            $manager->persist($page);
            $manager->flush();
        }
    }

    private function trimParagraph(int $length = 240, bool $htmlTagP = false) {
        $lorem = new LoremIpsum();
        
        return  ($htmlTagP ? '<p>' : '') . substr($lorem->paragraph(), 0, $length) . ($htmlTagP ? '</p>' : '');
    }
}
